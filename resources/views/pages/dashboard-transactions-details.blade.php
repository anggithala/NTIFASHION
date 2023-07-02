@extends('layouts.dashboard')

@section('title')
    Dashboard Transactions Details
@endsection

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"
                        form="formReview{{ $transactionDetails->product->id }}">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@section('content')
    @php
        $timestamp = $transaction->created_at; // timestamp awal
        $timezone = 'Asia/Jakarta'; // zona waktu lokal Indonesia
        setlocale(LC_TIME, 'id_ID'); // set locale ke bahasa Indonesia
        $local_time = Carbon\Carbon::createFromTimestamp(strtotime($timestamp))
            ->setTimezone($timezone)
            ->locale('id_ID')
            ->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
    @endphp
    <!-- Section Content-->
    <div class="section-content section-dashboard-home m-0 p-3" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title mb-3">Transaction Details</h2>
                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex">
                        <div>
                            <p class="dashboard-subtitle m-0">Code:
                            <div class="btn btn-info">{{ $transaction->code }}</div>
                            </p>
                            <p class="dashboard-subtitle m-0">Total:
                            <div class="btn btn-info">Rp {{ number_format($transaction->total_price) }}</div>
                            </p>

                        </div>
                        <div class="ml-3">
                            <p class="dashboard-subtitle m-0">Time:
                            <div class="btn btn-info">{{ $local_time }}</div>
                            </p>
                            <p class="dashboard-subtitle m-0">Payment Status:
                            <div class="btn btn-info">{{ ucwords(strtolower($transaction->transaction_status)) }}</div>
                            </p>
                        </div>
                        <div class="ml-3">
                            <p class="dashboard-subtitle m-0">Shipping Status:
                            <div class="btn btn-info">{{ ucwords(strtolower($transaction->shipping_status)) }}</div>
                            </p>
                        </div>
                    </div>
                    @if ($transaction->transaction_status != 'SUCCESS')
                        <div>
                            <a href="{{ $transaction->payment_url }}" class="btn btn-success " target="_blank">Payment
                                Now</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="dashboard-content mt-3" id="transactionDetails">
                <div class="row">
                    @foreach ($transaction->transactionDetails as $transactionDetails)
                        <div class="col-sm-6 mb-3">
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
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-inline-flex">
                                        <div class="border border-primary-subtle"
                                            style="width: 240px; aspect-ratio: 1 / 1; background-image: url({{ Storage::url($transactionDetails->product->productGalleries->first()->photos) }}); background-position: center; background-size: cover;">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="card-title">{{ $transactionDetails->product->name }}</h4>
                                            <p class="m-0">Ukuran: {{ $transactionDetails->size }}</p>
                                            <p class="m-0">Berat: {{ $transactionDetails->product->weight }} gram</p>
                                            <p class="m-0">Harga:
                                                Rp{{ number_format($transactionDetails->product->price) }}</p>
                                            <p>Kode Produk: {{ $transactionDetails->code }}</p>
                                            <h5 class="m-0">Deskripsi:</h5>
                                            {!! $transactionDetails->product->description !!}
                                        </div>
                                    </div>

                                    <div class="col text-right">
                                        @if (Auth::user()->reviews()->where('product_id', $transactionDetails->product->id)->exists())
                                            <button type="button" class="btn btn-success disabled">Selesai</button>
                                        @else
                                            @if ($transaction->transaction_status == 'SUCCESS' && $transaction->shipping_status == 'SHIPPING')
                                                <form method="POST" class="d-none" id="transaction-received"
                                                    action="{{ route('dashboard-transactions-received', ['id' => $transaction->id]) }}">
                                                    @csrf
                                                </form>
                                                <button type="submit" form="transaction-received"
                                                    class="btn btn-primary">Pesanan Diterima</button>
                                            @endif
                                            @if ($transaction->transaction_status == 'SUCCESS' && $transaction->shipping_status == 'SUCCESS')
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#productReviewsModal{{ $transactionDetails->product->id }}">Review</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Shipping Information</h4>
                                <p class="m-0">Alamat 1: {{ $transaction->user->address_one }}</p>
                                <p class="m-0">Alamat 2: {{ $transaction->user->address_two }}</p>
                                <p class="m-0">Provinsi:
                                    {{ Dipantry\Rajaongkir\Models\ROProvince::find($transaction->user->provinces_id)->name }}
                                </p>
                                <p class="m-0">Kabupaten/Kota:
                                    {{ Dipantry\Rajaongkir\Models\ROCity::find($transaction->user->provinces_id)->name }}
                                </p>
                                <p class="m-0">Kode POS: {{ $transaction->user->zip_code }}</p>
                                <p class="m-0">Negara: {{ $transaction->user->country }}</p>
                                <p class="m-0">Nomor Telepon: {{ $transaction->user->phone_number }}</p>
                                <p class="m-0">Kurir: {{ $transaction->courier }}</p>
                                <p class="m-0">Jenis Ekspedisi: {{ $transaction->service }}</p>
                                <p class="m-0">Resi: {{ $transactionDetails->resi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
