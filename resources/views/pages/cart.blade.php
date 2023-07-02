@extends('layouts.app')

@section('title')
    Category Cart Page
@endsection

@section('content')
    <!--Page Content-->
    <div class="page-content page-cart mt-2">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cart
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Product Name</td>
                                    <td>Size</td>
                                    <td>Weight</td>
                                    <td>Price</td>
                                    <td>Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width: 15%;">
                                            @if ($cart->product->productGalleries)
                                                <img src="{{ Storage::url($cart->product->productGalleries->first()->photos) }}"
                                                    alt="" class="cart-image w-100">
                                            @endif
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                        </td>
                                        <td style="width: 15%;">
                                            <div class="product-title">{{ $cart->selected_size }}</div>
                                        </td>
                                        <td style="width: 15%;">
                                            <div class="product-title">{{ $cart->product->weight }} g</div>
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">Rp {{ number_format($cart->product->price) }}</div>
                                            <div class="product-subtitle">Rupiah</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-remove-cart">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $totalPrice += $cart->product->price;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-4" data-aos="fade-up" data-aos-delay="150">
                    <h1 class="h2">Shipping Details</h1>
                </div>
                <form action="{{ route('checkout') }}" id="checkout" enctype="multipart/form-data" method="POST">
                    @csrf
                    @php
                        $totalWeight = 0;

                        foreach ($carts as $cart) {
                            $totalWeight += $cart->product->weight;
                        }
                    @endphp
                    <input type="hidden" class="d-none" name="city" value="{{ $currentCity->id }}">
                    <input type="hidden" class="d-none" name="origin_province" value="{{ $adminProvince->id }}" />
                    <input type="hidden" class="d-none" name="origin_city" value="{{ $adminCity->id }}" />
                    <input type="hidden" class="d-none" name="origin_postal_code" value="{{ $adminCity->postal_code }}" />
                    <input type="hidden" class="d-none" name="total_weight" value="{{ $totalWeight }}" readonly />
                    <input type="hidden" class="d-none" name="shipping_price" value="" />
                    <input type="hidden" class="d-none" name="insurance_price" value="10000" />
                    <input type="hidden" class="d-none" name="total_price" value="{{ 10000 + $totalPrice }}" />
                    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                        <h3>Destination</h3>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" id="name" value="{{ $user->name }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Address 1</label>
                                <textarea class="form-control" name="address_one" id="address_one" style="resize: none;" wrap readonly>{{ $user->address_one }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <textarea class="form-control" name="address_two" id="address_two" style="resize: none;" wrap readonly>{{ $user->address_two }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="{{ $currentProvince->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city"
                                    value="{{ $currentCity->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    value="{{ $user->zip_code }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="{{ $user->country }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ $user->phone_number }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                        <h3>Store Address</h3>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="origin_name">Name</label>
                                <input class="form-control" name="origin_name" id="origin_name" value="NTI Fashion"
                                    readonly />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="origin_address">Address</label>
                                <textarea class="form-control" name="origin_address" id="origin_address" style="resize: none;" wrap readonly>{{ $admin->address_one }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="origin_province_show">Province</label>
                                <input type="text" class="form-control" id="origin_province_show"
                                    value="{{ $adminProvince->name }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="origin_city_show">City</label>
                                <input type="text" class="form-control" id="origin_city_show"
                                    value="{{ $adminCity->name }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="text" class="form-control" id="zip_code"
                                    value="{{ $admin->zip_code }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="origin_country">Country</label>
                                <input type="text" class="form-control" id="origin_country" name="origin_country"
                                    value="Indonesia" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                        <h3>Additional</h3>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="totalWeight_show">Total Weight (gram)</label>
                                <input type="text" class="form-control" id="totalWeight_show"
                                    value="{{ $totalWeight }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="courier">Courier</label>
                                <select name="courier" id="courier" class="form-control form-select">
                                    <option value="">-- Pilih Jasa Kurir --</option>
                                    @foreach ($couriers as $courier)
                                        <option value="{{ $courier }}">{{ strtoupper($courier) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service">Service</label>
                                <input type="hidden" name="service_hidden">
                                <select name="service" id="service" class="form-control form-select" disabled>
                                    <option value="">-- Pilih Pelayanan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cost">Shipping Price (Rupiah)</label>
                                <input type="text" class="form-control" id="cost" name="cost" value=""
                                    readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="etd">ETD</label>
                                <input type="text" class="form-control" id="etd" name="etd" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <h2 class="mb-2">Payment Information</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-6 col-md-3">
                            <div class="product-title" id="shipping_price_preview">Rp 0</div>
                            <div class="product-subtitle">Shipping Price</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="product-title">Rp 10,000</div>
                            <div class="product-subtitle">Insurance Tax</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="product-title text-success" id="total_price_preview">Rp
                                {{ number_format(10000 + $totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="submit" class="btn btn-success mt-4 px-4 btn-block disabled" form="checkout">
                                Checkout Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            const originProvince = $('input[name="origin_province"]');
            const originCity = $('input[name="origin_city"]');
            const originPostalCode = $('input[name="origin_postal_code"]');
            const destinationCity = $('input[name="city"]');
            const totalWeight = $('input[name="total_weight"]');
            const courier = $('select[name="courier"]');
            const serviceHidden = $('input[name="service_hidden"]');
            const service = $('select[name="service"]');
            const cost = $('input[name="cost"]');
            const etd = $('input[name="etd"]');
            const shippingPrice = $('input[name="shipping_price"]');
            const insurancePrice = $('input[name="insurance_price"]');
            const totalPrice = $('input[name="total_price"]');

            const shippingPricePreview = $('#shipping_price_preview');
            const totalPricePreview = $('#total_price_preview');

            const buttonCheckout = $('button[form="checkout"]');

            const tempTotalPrice = parseInt(totalPrice.val());

            courier.on('change', function() {
                service.empty();
                service.append('<option value="">-- Pilih Pelayanan --</option>');
                service.attr('disabled', 'disabled');

                cost.attr('value', '');
                etd.attr('value', '');

                totalPrice.attr('value', tempTotalPrice);
                totalPricePreview.text(formatRupiah(totalPrice.val()));

                shippingPrice.attr('value', '');
                shippingPricePreview.text('Rp 0');

                buttonCheckout.addClass('disabled');

                const provinceId = $(this).val();

                if ($(this).val()) {
                    $.ajax({
                        url: `/rajaongkir/origin-${originCity.val()}/destination-${destinationCity.val()}/weight-${totalWeight.val()}/courier-${courier.val()}/ongkos-kirim`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            service.removeAttr('disabled');
                            $.each(data, function(key1, value) {
                                service.append(
                                    `<option value="${key1}">${value['description']} (${value['service']})</option>`
                                );
                                $.each(value['cost'], function(key2, value) {
                                    cost.append(
                                        `<option value="${key2}">${value['value']}</option>`
                                    )
                                })
                            });
                        }
                    });
                } else {
                    service.empty();
                    service.append('<option value="">-- Pilih Pelayanan --</option>');
                    service.attr('disabled', 'disabled');
                }
            });

            service.on('change', function() {
                const selectedText = $(this).find('option:selected').text();
                serviceHidden.val(selectedText);
                if ($(this).val()) {
                    $.ajax({
                        url: `/rajaongkir/origin-${originCity.val()}/destination-${destinationCity.val()}/weight-${totalWeight.val()}/courier-${courier.val()}/ongkos-kirim`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key1, value) {
                                $.each(value.cost, function(key2, value) {
                                    cost.removeAttr('disabled');
                                    etd.removeAttr('disabled');

                                    if (key1 == service.val()) {
                                        cost.attr('value', value.value);
                                        let etdDays = value.etd.split("-");
                                        let etdMessage;

                                        if (etdDays[0] == etdDays[1]) {
                                            etdMessage = "BESOK";
                                        } else if (etdDays[0] == 1) {
                                            etdMessage =
                                                `BESOK SAMPAI ${etdDays[1]} HARI`;
                                        } else if (etdDays[0] | etdDays[1]) {
                                            etdMessage =
                                                `${etdDays[0]} SAMPAI ${etdDays[1]} HARI`;
                                        } else {
                                            etdMessage = `${etdDays[0]}`
                                        }

                                        etd.attr('value', etdMessage);

                                        shippingPrice.attr('value', cost.val());
                                        shippingPricePreview.text(formatRupiah(
                                            shippingPrice.val()));
                                        totalPrice.attr('value', parseInt(
                                                shippingPrice.val()) +
                                            tempTotalPrice);
                                        totalPricePreview.text(formatRupiah(
                                            totalPrice.val()));

                                        if (parseInt(totalPrice.val()) >
                                            tempTotalPrice) {
                                            buttonCheckout.removeClass(
                                                'disabled');
                                        }
                                    }
                                })
                            });
                        }
                    });
                } else {
                    cost.attr('value', '');
                    etd.attr('value', '');

                    totalPrice.attr('value', tempTotalPrice);
                    totalPricePreview.text(formatRupiah(totalPrice.val()));
                    shippingPrice.attr('value', '');
                    shippingPricePreview.text('Rp 0');

                    buttonCheckout.addClass('disabled');
                }
            });

            function formatRupiah(angka) {
                let bilangan = angka.toString(),
                    sisa = bilangan.length % 3,
                    rupiah = bilangan.substr(0, sisa),
                    ribuan = bilangan.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    let separator = sisa ? "," : "";
                    rupiah += separator + ribuan.join(",");
                }

                return `Rp ${rupiah}`;
            }
        });
    </script>
@endpush
