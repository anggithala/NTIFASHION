@extends('layouts.app')

@section('title')
    Categories | {{ $category->name }}
@endsection

@section('content')
    <!-- Page Content-->
    <div class="page-content page-custom mt-2">
        <section class="store-new-product">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h3>{{ $category->name }}</h3>
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
                                    Rp {{ $product->price }}
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center y-5" data-aos="fade-up" data-aos-delay="100">
                            No Products Found
                        </div>
                    @endforelse
                </div>
                <div class="row">
                    <div class="col-12 mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
