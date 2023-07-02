@extends('layouts.owner')

@section('title')
    Administrator Transactions Details
@endsection

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
                <img src="" alt="">
                <h2 class="dashboard-title">Edit "{{ $transaction->user->name }}" Transaction</h2>
                <p class="dashboard-subtitle"></p>
            </div>
            <div class="dashboard-heading">
                <h2 class="dashboard-title mb-3">Transaction Details</h2>
                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex">
                        <div>
                            <p class="dashboard-subtitle m-0">Code:
                            <div class="btn btn-info">{{ $transaction->code }}</div>
                            </p>
                            <p class="dashboard-subtitle m-0">Created:
                            <div class="btn btn-info">{{ $local_time }}</div>
                            </p>
                        </div>
                        <div class="ml-3">
                            <p class="dashboard-subtitle m-0">Total:
                            <div class="btn btn-info">Rp {{ number_format($transaction->total_price) }}</div>
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
                </div>
            </div>
            <div class="dashboard-content mt-3" id="transactionDetails">
                <div class="row">
                    @foreach ($transaction->transactionDetails as $transactionDetails)
                        <div class="col-sm-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-inline-flex">
                                        <div class="border border-primary-subtle"
                                            style="width: 240px; aspect-ratio: 1 / 1; background-image: url({{ Storage::url($transactionDetails->product->productGalleries->first()->photos) }}); background-position: center; background-size: cover;">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="card-title">{{ $transactionDetails->product->name }}</h4>
                                            <p class="m-0">Ukuran: {{ $transactionDetails->size }}</p>
                                            <p class="m-0">Harga:
                                                Rp {{ number_format($transactionDetails->product->price) }}</p>
                                            <p>Kode Produk: {{ $transactionDetails->code }}</p>
                                            <h5 class="m-0">Deskripsi:</h5>
                                            {!! $transactionDetails->product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informasi Pengiriman</h4>
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
                                <p class="m-0">Kurir: {{ $transaction->service }}</p>
                                <p class="m-0">Resi: {{ $transactionDetails->resi }}</p>
                            </div>
                            <form action="{{ route('transaksi.update', $transaction->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Transaction Status</label>
                                        <select name="transaction_status" class="form-select form-control">
                                            <option value="{{ $transaction->transaction_status }}">
                                                {{ $transaction->transaction_status }}</option>
                                            @if ($transaction->transaction_status == 'PENDING')
                                                <option value="SUCCESS">SUCCESS</option>
                                            @else
                                                <option value="PENDING">PENDING</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row px-3">
                                    <div class="col-3">
                                        <div class="product-title">Shipping Status</div>
                                        <select name="shipping_status" class="form-select form-control"
                                            v-model="shipping_status" id="shipping_status">
                                            <option value="{{ $transaction->shipping_status }}">
                                                {{ $transaction->shipping_status }}</option>
                                            @if ($transaction->shipping_status == 'PENDING')
                                                <option value="SHIPPING">SHIPPING</option>
                                                <option value="SUCCESS">SUCCESS</option>
                                            @elseif ($transaction->shipping_status == 'SHIPPING')
                                                <option value="PENDING">PENDING</option>
                                                <option value="SUCCESS">SUCCESS</option>
                                            @else
                                                <option value="PENDING">PENDING</option>
                                                <option value="SHIPPING">SHIPPING</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <template class="col-3" v-if="shipping_status == 'SHIPPING'">
                                            <div>
                                                <div class="product-title">Input Resi</div>
                                                <input type="text" class="form-control" name="resi" v-model="resi"
                                                    value="{{ $transaction->transactionDetails->first()->resi }}" />
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success mt-4 btn-block">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: "#transactionDetails",
            data: {
                shipping_status: "{{ $transaction->shipping_status }}",
                resi: "{{ $transaction->transactionDetails->first()->resi }}",
            },
        });
    </script>
@endpush
