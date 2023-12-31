@extends('layouts.admin')

@section('title')
    Transaction
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">List Of Transaction</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.transactions.print') }}" class="btn btn-primary mb-3"
                                    data-toggle="modal" data-target="#printModal">
                                    Print
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Payment Status</th>
                                                <th>Shipping Status</th>
                                                <th>Created</th>
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

@push('outside')
    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.transactions.print') }}" method="GET" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Pilih Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="startDate" class="fw-bold">Tanggal Mulai</label>
                    <div class="d-flex">
                        <div>
                            <label for="startMonth">Bulan</label>
                            <select name="startMonth" class="custom-select" required>
                                <option value="" selected disabled>Pilih bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="ml-3">
                            <label for="startYear">Tahun</label>
                            <select name="startYear" class="custom-select" required>
                                <option value="" selected disabled>Pilih tahun</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                            </select>
                        </div>
                    </div>
                    <label for="endDate" class="mt-3 fw-bold">Tanggal Akhir</label>
                    <div class="d-flex">
                        <div>
                            <label for="endMonth">Bulan</label>
                            <select name="endMonth" class="custom-select" required>
                                <option value="" selected disabled>Pilih bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="ml-3">
                            <label for="endYear">Tahun</label>
                            <select name="endYear" class="custom-select" required>
                                <option value="" selected disabled>Pilih tahun</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                            </select>
                        </div>
                    </div>
                    <label for="transaction_status" class="mt-3 fw-bold">Status Pembayaran</label>
                    <div class="d-flex">
                        <div>
                            <select name="transaction_status" class="custom-select" required>
                                <option value="" selected disabled>Pilih Status Pembayaran</option>
                                <option>PENDING</option>
                                <option>SUCCESS</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'total_price',
                    name: 'total_price'
                },
                {
                    data: 'transaction_status',
                    name: 'transaction_status'
                },
                {
                    data: 'shipping_status',
                    name: 'shipping_status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush
