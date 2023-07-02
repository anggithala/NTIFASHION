@extends('layouts.admin')

@section('title')
    Reviews
@endsection

@foreach ($reviews as $review)
<!-- Modal Review Reply -->
<div class="modal fade" id="reviewReplyModal{{ $review->id }}" tabindex="-1" aria-labelledby="reviewReplyModal{{ $review->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="reviewReplyModal{{ $review->id }}Label">Beri Balasan Ulasan Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col" style="min-width: 100px; aspect-ratio: 1 / 1; background-image: url({{ Storage::url($review->product->productGalleries->first()->photos) }}); background-position: center; background-size: cover;"></div>
                    <h4 class="h4 text-center mt-3 mb-5">{{ $review->product->name }}</h4>
                </div>
                <form action="{{ route('review.store', ['id' => $review->id]) }}" method="POST" id="reviewReply{{ $review->id }}">
                @csrf
                @method('post')
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="text" class="form-control" id="rating" value="{{ $review->rating }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea class="form-control" id="comment" style="height: 100px" readonly>{{ $review->comment }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="reply" class="form-label">Balasan</label>
                        <textarea class="form-control" name="reply" id="reply" placeholder="Silakan berikan balasan Anda..." style="height: 100px" {{ ($review->replies->first() != NULL) ? 'disabled' : '' }}>{{ ($review->replies->first() != NULL) ? $review->replies->first()->message : '' }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @if ($review->replies->first() == NULL)
                <button type="submit" class="btn btn-primary" form="reviewReply{{ $review->id }}">Kirim Balasan</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Reviews</h2>
                <p class="dashboard-subtitle">List Of Product Reviews</p>
            </div>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @error('reply')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="tableReviews">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Reviewer</th>
                                                <th>Gambar Produk</th>
                                                <th>Rating</th>
                                                <th>Waktu Dibuat</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('addon-script')
    <script>
        $(document).ready(function() {

            var datatable = $('#tableReviews').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'product_image',
                        name: 'product_image'
                    },
                    {
                        data: 'rating',
                        name: 'rating'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });
    </script>
@endpush
