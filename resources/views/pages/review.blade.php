@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Review</h2>
                <p class="dashboard-subtitle">
                    Your review means a lot to us
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
                                    role="tab" aria-controls="pills-home" aria-selected="true">Review Product</a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-3">
                              <div class="card">
                                <div class="card-body">
                                    <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                                  <h5 class="card-title">Special title treatment</h5>
                                  
                                  <a href="{{ route('pages.comment') }}" class="btn btn-primary">Go somewhere</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="card">
                                <div class="card-body">
                                    <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                                  <h5 class="card-title">Special title treatment</h5>
                                  
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="card">
                                <div class="card-body">
                                    <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                                  <h5 class="card-title">Special title treatment</h5>
                                  
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="card">
                                <div class="card-body">
                                    <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                                  <h5 class="card-title">Special title treatment</h5>
                                  
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
