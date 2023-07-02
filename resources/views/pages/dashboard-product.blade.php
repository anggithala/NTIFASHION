@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Products</h2>
                <p class="dashboard-subtitle">Manage it well and get money</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="/dashboard-product-create.html" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/Product-card-1.png" alt="" class="w-100 mb-2" />
                                <div class="product-title">Blouse Batik</div>
                                <div class="product-category">Batik</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/Product-card-2.png" alt="" class="w-100 mb-2" />
                                <div class="product-title">DILLA NAVY BLOUSE</div>
                                <div class="product-category">Custom</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/Product-card-3.png" alt="" class="w-100 mb-2" />
                                <div class="product-title">Lousia's Batik</div>
                                <div class="product-category">Batik</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/Product-card-4.png" alt="" class="w-100 mb-2" />
                                <div class="product-title">Skinny Jeans</div>
                                <div class="product-category">Celana</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/Product-card-5.png" alt="" class="w-100 mb-2" />
                                <div class="product-title">White Blouse</div>
                                <div class="product-category">Custom</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
