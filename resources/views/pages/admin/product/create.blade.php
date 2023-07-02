@extends('layouts.admin')

@section('title')
    Product
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">Create New Product</p>
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
                                {{ route('product.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <select name="categories_id" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" id="S" name="size[]" value="S">
                                                    <label for="S">S</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" id="M" name="size[]" value="M">
                                                    <label for="M">M</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" id="L" name="size[]" value="L">
                                                    <label for="L">L</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" id="XL" name="size[]" value="XL">
                                                    <label for="XL">XL</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Item Weight</label>
                                                <select name="weight" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="">-- Pilih Berat Item --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" name="price" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description Product</label>
                                                <textarea name="description" id="editor"></textarea>
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {

            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => editor)
                .catch(error => {
                    console.error(error);
                });


            const itemWeight = $('select[name="weight"]');

            let defaultWeight = 100;
            let weight = 0;

            for (let i = 0; i < 20; i++) {
                weight = defaultWeight + (defaultWeight * i)
                itemWeight.append(`<option value="${weight}">${weight} gram`);
            }
        });
    </script>
@endpush
