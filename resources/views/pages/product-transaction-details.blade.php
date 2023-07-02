@extends('layouts.dashboard')

@foreach ($transaction->transactionDetails as $transactionDetails)
    <!-- Modal Product Reviews -->
    <div class="modal fade" id="productReviewsModal{{ $transactionDetails->product->id }}" tabindex="-1"
        aria-labelledby="productReviewsModal{{ $transactionDetails->product->id }}Label" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productReviewsModal{{ $transactionDetails->product->id }}Label">
                        Review Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Batal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col"
                            style="min-width: 100px; aspect-ratio: 1 / 1; background-image: url({{ Storage::url($transactionDetails->product->productGalleries->first()->photos) }}); background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <form id="formReview{{ $transactionDetails->product->id }}" method="POST"
                        action="{{ route('create-reviews', $transactionDetails->product->id) }}" class="row mt-3 mb-0">
                        @csrf
                        <h4 class="card-title text-center">{{ $transactionDetails->product->name }}</h4>
                        <div class="col">
                            <div class="mb-3">
                                <div class="text-center start" style="position: relative;z-index: 777">
                                    <span class="star-rating star-5">
                                        <input type="radio" name="rating" value="1"><i></i>
                                        <input type="radio" name="rating" value="2"><i></i>
                                        <input type="radio" name="rating" value="3"><i></i>
                                        <input type="radio" name="rating" value="4"><i></i>
                                        <input type="radio" name="rating" value="5"><i></i>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label for="comment{{ $transactionDetails->product->id }}"
                                    class="form-label">Comment</label>
                                <textarea name="comment" class="form-control" id="comment{{ $transactionDetails->product->id }}" rows="3"
                                    placeholder="Tuliskan komentar tentang produk" required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                    <button type="submit" class="btn btn-primary"
                        form="formReview{{ $transactionDetails->product->id }}">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <a class="btn btn-secondary my-4" href="{{ route('dashboard-transactions') }}">Prev</a>

                <h2 class="dashboard-title">Detail Product</h2>
                <p class="dashboard-subtitle">
                    Shows all transactions product
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12 mt-2">
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
                        @error('rating')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('comment')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">List Product</a>
                            </li>
                        </ul>
                        <div class="row mb-4">
                            @foreach ($transaction->transactionDetails as $transactionDetails)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col border"
                                                style="min-width: 100px; aspect-ratio: 1 / 1; background-image: url({{ Storage::url($transactionDetails->product->productGalleries->first()->photos) }}); background-position: center; background-size: cover;">
                                            </div>

                                            <div class="col p-0 mt-3">
                                                <h4 class="card-title text-center">{{ $transactionDetails->product->name }}
                                                </h4>
                                                <p class="m-0">Ukuran: {{ $transactionDetails->size }}</p>
                                                <p class="m-0">Harga:
                                                    Rp{{ number_format($transactionDetails->product->price) }}</p>
                                                <p class="m-0">Resi: {{ $transactionDetails->resi }}</p>
                                                <p>Kode Produk: {{ $transactionDetails->code }}</p>
                                                <h5 class="m-0">Deskripsi:</h5>
                                                {!! $transactionDetails->product->description !!}
                                            </div>

                                            @if (Auth::user()->reviews()->where('product_id', $transactionDetails->product->id)->exists())
                                                <button type="button" class="btn btn-success disabled">Selesai</button>
                                            @else
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#productReviewsModal{{ $transactionDetails->product->id }}">Review</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
