@extends('layouts.app')

@section('title')
    Product Details
@endsection

@section('content')
    <!--Page Content-->
    <div class="page-content page-details mt-2">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @error('size')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Product Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="">
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-8 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id"
                                data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="zoom-in">
                        <div class="row">
                            <section class="store-heading">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>{{ $product->name }}</h2>
                                        <div class="price">Rp {{ number_format($product->price) }}</div>
                                    </div>
                                </div>
                            </section>

                            <form action="{{ route('detail-add', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <section class="size">
                                    <div class="row">
                                        <div class="col-lg-1 col-1 {{ !$sizeS ? 'd-none' : '' }}">
                                            <div class="form-size">
                                                <input type="radio" name="size" id="S" value="S" />
                                                <label for="S">S</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-1 {{ !$sizeM ? 'd-none' : '' }}">
                                            <div class="form-size">
                                                <input type="radio" name="size" id="M" value="M" />
                                                <label for="M">M</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-1 {{ !$sizeL ? 'd-none' : '' }}">
                                            <div class="form-size">
                                                <input type="radio" name="size" id="L" value="L" />
                                                <label for="L">L</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-1 {{ !$sizeXL ? 'd-none' : '' }}">
                                            <div class="form-size">
                                                <input type="radio" name="size" id="XL" value="XL" />
                                                <label for="XL">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <div class="row">
                                        <div class="col-lg-12" data-aos="zoom-in">
                                            <h5>Berat per item: {{ $product->weight }} gram</h5>
                                        </div>
                                    </div>
                                </section>

                                <section class="button-cart">
                                    <div class="row">
                                        <div class="col-lg-12" data-aos="zoom-in">
                                            @auth
                                                <button type="submit" class="btn btn-light px-4 text-white btn-block mb-3">
                                                    ADD TO CART
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="btn btn-light px-4 text-white btn-block mb-3">
                                                    ADD TO CART
                                                </a>
                                            @endauth
                                        </div>
                                </section>
                            </form>

                            <section class="store-description">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-review">
            <div class="container border border-dark rounded">
                <div class="row mt-3">
                    <div class="col-12 col-lg-8 mb-2">
                        <h4>Customer Review</h4>
                    </div>

                    <div class="d-flex flex-column col-12 col-lg-8 mb-3">
                        @php
                            $totalRate5 = $reviews->where('rating', 5)->count();
                            $totalRate4 = $reviews->where('rating', 4)->count();
                            $totalRate3 = $reviews->where('rating', 3)->count();
                            $totalRate2 = $reviews->where('rating', 2)->count();
                            $totalRate1 = $reviews->where('rating', 1)->count();
                            $totalRate = $totalRate1 + $totalRate2 + $totalRate3 + $totalRate4 + $totalRate5;
                        @endphp
                        @if ($totalRate)
                            <h5>Rating ★5 ({{ $totalRate5 }})</h5>
                            <div class="progress mb-2">
                                <div class="progress-bar" role="progressbar"
                                    style="{{ 'width: calc(' . ($totalRate5 * 100) / $totalRate . '%);' }}"></div>
                            </div>
                            <h5 class="mt-2">Rating ★4 ({{ $totalRate4 }})</h5>
                            <div class="progress mb-2">
                                <div class="progress-bar" role="progressbar"
                                    style="{{ 'width: calc(' . ($totalRate4 * 100) / $totalRate . '%);' }}"></div>
                            </div>
                            <h5 class="mt-2">Rating ★3 ({{ $totalRate3 }})</h5>
                            <div class="progress mb-2">
                                <div class="progress-bar" role="progressbar"
                                    style="{{ 'width: calc(' . ($totalRate3 * 100) / $totalRate . '%);' }}"></div>
                            </div>
                            <h5 class="mt-2">Rating ★2 ({{ $totalRate2 }})</h5>
                            <div class="progress mb-2">
                                <div class="progress-bar" role="progressbar"
                                    style="{{ 'width: calc(' . ($totalRate2 * 100) / $totalRate . '%);' }}"></div>
                            </div>
                            <h5 class="mt-2">Rating ★1 ({{ $totalRate1 }})</h5>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                    style="{{ 'width: calc(' . ($totalRate1 * 100) / $totalRate . '%);' }}"></div>
                            </div>
                        @else
                            <p>Belum ada review.</p>
                        @endif

                    </div>

                </div>

                <hr />

                <div class="d-flex flex-column pl-3" style="height: 400px; position:relative;">
                    <ul class="list-unstyled h-0 overflow-auto" id="review-list">
                        @foreach ($reviews as $review)
                            <li class="media mb-3">
                                <div class="rounded-circle mr-3"
                                    style="width: 48px; height: 48px; background-image: url({{ asset('storage/' . $review->user->avatar) }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                </div>
                                <div class="media-body">
                                    @php
                                        $reviewAt = $review->created_at; // waktu dalam bentuk timestamp
                                        $date = Carbon\Carbon::parse($reviewAt)->locale('id'); // waktu sekarang dalam bentuk Carbon
                                        $diffReview = $date->diffForHumans(); // perhitungan selisih waktu
                                    @endphp
                                    <h5 class="mt-0 mb-0">{{ $review->user->name }}</h5>
                                    <p><small>{{ $diffReview }}</small> • <small>Rating ★{{ $review->rating }}</small>
                                    </p>
                                    <p class="m-0">{{ $review->comment }}</p>
                                    <div class="d-flex flex-row h-25">
                                        @if ($review->replies->first())
                                            <small class="text-muted show-reply" data-reply="reply{{ $review->id }}"
                                                style="cursor: pointer;">Show Replies</small>
                                        @endif
                                    </div>

                                    @if ($review->replies->first() != null)
                                        <div class="media mt-3" id="reply{{ $review->id }}" style="display: none;">
                                            <div class="rounded-circle mr-3"
                                                style="width: 48px; height: 48px; background-image: url({{ asset('storage/' . $admin->avatar) }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                            </div>
                                            <div class="media-body">
                                                @php
                                                    $replyAt = $review->replies->first()->created_at; // waktu dalam bentuk timestamp
                                                    $date = Carbon\Carbon::parse($replyAt)->locale('id'); // waktu sekarang dalam bentuk Carbon
                                                    $diffReply = $date->diffForHumans(); // perhitungan selisih waktu
                                                @endphp
                                                <h5 class="mt-0 mb-0">NTI Fashion</h5>
                                                <small>{{ $diffReply }}</small>
                                                <p class="m-0">{{ $review->replies->first()->message }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-primary float-right rounded" id="scroll-to-top"
                        style="position:absolute; bottom:75px; right:25px;">Keatas &uarr;</button>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        $(document).ready(function() {

            var gallery = new Vue({
                el: "#gallery",
                mounted() {
                    AOS.init();
                },
                data: {
                    activePhoto: 0,
                    photos: [
                        @foreach ($product->productGalleries as $gallery)
                            {
                                id: {{ $gallery->id }},
                                url: "{{ Storage::url($gallery->photos) }}",
                            },
                        @endforeach
                    ],
                },
                methods: {
                    changeActive(id) {
                        this.activePhoto = id;
                    },
                },
            });

            $('.show-reply').on('click', function() {
                $(`#${$(this).data('reply')}`).toggle("slow");

                ($(this).text() === 'Show Replies') ? $(this).text('Hide Replies'): $(this).text(
                    'Show Replies');
            });
        });
    </script>
@endpush
