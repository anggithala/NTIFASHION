@extends('layouts.app')

@section('title')
    Store Homepage
@endsection

@section('content')
    <div class="page-content page-home mt-1">
        <section class="store-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                            <ul class="carousel-indicators">
                                <li data-target="#storeCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#storeCarousel" data-slide-to="1"></li>
                            </ul>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/images/Banner.png" alt="Carousel Image" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="/images/Banner2.png" alt="Carousel Image" class="d-block w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @php
                        $incrementCategory = 0;
                    @endphp
                    @forelse ($categories as $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up"
                            data-aos-delay="{{ $incrementCategory += 100 }}">
                            <a href="{{ 'category/' . $category->slug }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ Storage::url($category->photo) }}" alt="" class="w-100">
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            No Categories Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="store-new-product">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Product</h5>
                    </div>
                </div>
                <div class="row">
                    @php
                        $incrementProduct = 0;
                    @endphp
                    @forelse ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                            data-aos-delay="{{ $incrementProduct += 100 }}">
                            <a href="{{ route('detail', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                class="component-product d-block">
                                <div class="product-thumbnail">
                                    <div class="product-image"
                                        style="@if ($product->productGalleries) background-image: url(
                                            '{{ Storage::url($product->productGalleries->first()->photos) }}')
                                    @else
                                    Background-color: #eee @endif
                                    ">
                                    </div>
                                </div>
                                <div class="product-text">
                                    {{ $product->name }}
                                </div>
                                <div class="product-price">
                                    Rp {{ number_format($product->price) }}
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center y-5" data-aos="fade-up" data-aos-delay="100">
                            No Products Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
