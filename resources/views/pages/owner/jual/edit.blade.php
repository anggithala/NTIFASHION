@extends('layouts.owner')

@section('title')
    Penjualan
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Penjualan</h2>
                <p class="dashboard-subtitle">Edit Penjualan</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="
                                {{ route('jual.update', $item->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Pelanggan</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $item->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" name="produk" class="form-control"
                                                    value="{{ $item->produk }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" name="jumlah" class="form-control"
                                                    value="{{ $item->jumlah }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Harga</label>
                                                <input type="number" name="harga" class="form-control"
                                                    value="{{ $item->harga }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status Pembayaran</label>
                                                <select name="status_pembayaran" id="" class="form-control">
                                                    <option value="{{ $item->status_pembayaran }}" selected>Tidak diganti
                                                    </option>
                                                    <option value="LUNAS">LUNAS</option>
                                                    <option value="BELUM LUNAS">BELUM LUNAS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status Barang</label>
                                                <select name="status_barang" id="" class="form-control">
                                                    <option value="{{ $item->status_barang }}" selected>Tidak diganti
                                                    </option>
                                                    <option value="DIAMBIL">DIAMBIL</option>
                                                    <option value="BELUM DIAMBIL">BELUM DIAMBIL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Photo</label>
                                                <input type="file" name="photo" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
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
    </div>
@endsection
