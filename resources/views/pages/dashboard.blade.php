@extends('layouts.dashboard')

@section('title')
    Store Dashboard
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>
            <div class="dashboard-content">
                @if (session('message'))
                <div class="row mt-3">
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                </div>
                @endif
                <div class="row my-3">
                    <div class="col-12 mt-4 mb-2">
                        <h5>Recent Transaction</h5>
                    </div>
                </div>
                @foreach ($transactions as $transaction)
                {{ dd($transaction) }}
                <div class="row my-3">
                    <div class="card col-md-4 p-0">
                        <div class="alert alert-info" role="alert">
                            {{-- {{ $transaction->transaction_status }} --}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Detail Transaksi</h5>
                            <p class="card-text">Biaya asuransi : Rp {{ number_format($transaction->insurance_price) }}</p>
                            <p class="card-text">Ongkos kirim : Rp {{ number_format($transaction->shipping_price) }}</p>
                            <p class="card-text">Total biaya yang harus dikeluarkan : Rp {{ number_format($transaction->total_price) }}</p>
                            @if ($transaction->transaction_status != "PENDING")
                            <button class="btn btn-info disabled">{{ $transaction->transaction_status }}</button>
                            @else
                            <a href="{{ $transaction->payment_url }}" class="btn btn-primary" target="_blank">Bayar Sekarang</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
