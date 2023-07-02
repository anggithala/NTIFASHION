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
                    <div class="col-6 mt-2">
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
                        <div class="card">
                            <div class="row">
                                <div class="col-2"> <img src="https://i.imgur.com/xELPaag.jpg" width="70"
                                        class="rounded-circle mt-2 mx-3"> </div>
                                <div class="col-10">
                                    <div class="comment-box mt-2">
                                        <h4 class="mx-3">Please Review Here</h4>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="rating" class="form-label">Rating</label>
                                                <select name="rating" class="form-select" id="rating" required>
                                                    <option value="">--- Pilih Rating ---</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                    
                                        <div class="comment-area">
                                            <textarea class="form-control" placeholder="What is your comment?" rows="4"></textarea>
                                        </div>
                                        <div class="comment-btns mt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                   
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="pull-right"> <button
                                                        class="btn btn-primary">Send <i
                                                                class="fa fa-long-arrow-right ml-1 mb-2"></i></button> </div>
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
