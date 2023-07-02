@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transactions
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                    Big result start from the small one
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
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Recent Transactions</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-hover scroll-horizontal-vertical w-100 crudTable">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Insurance Price</th>
                                                                <th>Shipping Price</th>
                                                                <th>Total</th>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('.crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'insurance_price',
                    name: 'insurance_price'
                },
                {
                    data: 'shipping_price',
                    name: 'shipping_price'
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
