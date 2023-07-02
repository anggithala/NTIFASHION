@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Details
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Create New Product</h2>
                <p class="dashboard-subtitle">Create your own product</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category" class="form-control form-select">
                                                    <option value="" disabled>
                                                        Select Category
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Size</label><br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <label><input type="checkbox" name="size" value="S">
                                                            S</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label><input type="checkbox" name="size" value="M">
                                                            M</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label><input type="checkbox" name="size" value="L">
                                                            L</label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label><input type="checkbox" name="size" value="XL">
                                                            XL</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="editor"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="formFileMultiple" class="form-label">Thumbnails</label>
                                                <input type="file"
                                                    class="form-
                                                control"
                                                    id="formFileMultiple" multiple />
                                                <p class="text-muted">
                                                    Kamu dapat memilih lebih dari satu file
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush
