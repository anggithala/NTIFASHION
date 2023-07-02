@extends('layouts.admin')

@section('title')
    Settings
@endsection

@section('content')
    <!-- Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Administrator</h2>
                <p class="dashboard-subtitle">Account Settings</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    @if (session('success'))
                        <div class="col-12">
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-12">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <div id="test_update">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <form method="POST" action="{{ route('admin.update.info') }}" id="update_info">
                                            @csrf
                                            <div class="mb-3">
                                                <h4>Update Information Account</h4>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Your Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $user->name }}" />
                                                            @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Your Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ $user->email }}" />
                                                            @error('email')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address_one">Address 1</label>
                                                            <input type="text" class="form-control" id="address_one"
                                                                name="address_one" value="{{ $user->address_one }}" />
                                                            @error('address_one')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address_two">Address 2</label>
                                                            <input type="text" class="form-control" id="address_two"
                                                                name="address_two" value="{{ $user->address_two }}" />
                                                            @error('address_two')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone_number">Phone Number</label>
                                                            <input type="text" class="form-control" id="phone_number"
                                                                name="phone_number" value="{{ $user->phone_number }}" />
                                                            @error('phone_number')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="provinces">Province</label>
                                                            <select name="provinces" id="provinces"
                                                                class="form-control form-select" v-model="provinces"
                                                                v-if="provinces">
                                                                @if ($currentProvince)
                                                                    <option value="{{ $currentProvince->id }}" selected>
                                                                        {{ $currentProvince->name }}</option>
                                                                @else
                                                                    <option value="">-- Pilih Provinsi --</option>
                                                                @endif
                                                                @foreach ($provinces as $province)
                                                                    <option value="{{ $province->id }}">
                                                                        {{ $province->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('provinces')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="regencies">City</label>
                                                            <select name="regencies" id="regencies"
                                                                class="form-control form-select" disabled="disabled"
                                                                v-model="regencies" v-if="regencies">
                                                                @if ($currentCity)
                                                                    <option value="{{ $currentCity->id }}" selected>
                                                                        {{ $currentCity->name }}</option>
                                                                @else
                                                                    <option value="">-- Pilih Kabupaten/Kota --
                                                                    </option>
                                                                @endif
                                                            </select>
                                                            @error('regencies')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="zip_code">Postal Code</label>
                                                            <input type="text" class="form-control" id="zip_code"
                                                                name="zip_code" value="{{ $user->zip_code }}" />
                                                            @error('zip_code')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country">Country</label>
                                                            <input type="text" class="form-control" id="country"
                                                                name="country"
                                                                value="{{ $user->country ? $user->country : 'Indonesia' }}"
                                                                disabled />
                                                            @error('country')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button type="submit" class="btn btn-success px-5"
                                                            form="update_info">
                                                            Update Information Account
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-md-6">
                                            <form method="POST" action="{{ route('admin.update.password') }}"
                                                id="update_password">
                                                @csrf
                                                <div class="mt-5 mb-3">
                                                    <h4>Update Password</h4>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="current_password"
                                                        class="form-label">{{ __('Current Password') }}</label>
                                                    <input type="password" id="current_password" name="current_password"
                                                        class="form-control">
                                                    @error('current_password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="new_password"
                                                        class="form-label">{{ __('New Password') }}</label>
                                                    <input type="password" id="new_password" name="new_password"
                                                        class="form-control">
                                                    @error('new_password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="new_password_confirmation"
                                                        class="form-label">{{ __('New Password Confirmation') }}</label>
                                                    <input type="password" id="new_password_confirmation"
                                                        name="new_password_confirmation" class="form-control">
                                                    @error('new_password_confirmation')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 text-right">
                                                    <button type="submit" class="btn btn-success px-5"
                                                        form="update_password">
                                                        Update Password
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form method="POST" action="{{ route('admin.update.avatar') }}"
                                                enctype="multipart/form-data" id="update_avatar">
                                                @csrf
                                                <div class="mt-5 mb-3">
                                                    <h4>Update Avatar</h4>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="avatar" class="form-label">{{ __('Avatar') }}</label>
                                                    <img src="{{ asset(!$user->avatar ? '/images/icon-user.png' : 'storage/' . $user->avatar) }}"
                                                        class="d-block img-preview col-4 mb-3">
                                                    <input type="file" id="avatar" name="avatar"
                                                        class="form-control" onchange="previewImage()">
                                                    @error('avatar')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 text-right">
                                                    <button type="submit" class="btn btn-success px-5"
                                                        form="update_avatar">
                                                        Update Avatar
                                                    </button>
                                                </div>
                                            </form>
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
        function getExtension(file) {
            return file.type.split('/').pop();
        }

        function previewImage() {
            const image = document.querySelector('#avatar');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            const file = image.files[0];

            oFReader.readAsDataURL(file);

            oFReader.onload = function(oFREvent) {
                const mimes = ['jpeg', 'jpg', 'png']
                const extension = getExtension(file);

                console.log(extension)
                const validExtension = mimes.includes(extension);

                if (validExtension) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        }

        $(document).ready(function() {
            const province = $('select[name="provinces"]');
            const city = $('select[name="regencies"]');
            const postalCode = $('input[name="zip_code"]');

            province.on('change', function() {
                city.empty();
                city.append('<option value="">-- Pilih Kabupaten/Kota --</option>');

                postalCode.attr('value', '');

                const provinceId = $(this).val();

                if (provinceId) {
                    $.ajax({
                        url: `/province/${provinceId}/cities`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            city.removeAttr('disabled');

                            $.each(data, function(key, value) {
                                city.append(
                                    `<option value="${value.id}">${value.name}</option>`
                                );
                            });
                        }
                    });
                } else {
                    city.attr('disabled', 'disabled');
                }
            });

            city.on('change', function() {
                const cityId = $(this).val();

                if (cityId) {
                    $.ajax({
                        url: `/city/${cityId}/postal-code`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                postalCode.attr('value', value.postal_code);
                            });
                        }
                    });
                } else {
                    postalCode.attr('value', '');
                }
            });

            $('form[id="update_info"]').on('submit', function() {
                $('select[name="regencies"]').removeAttr('disabled');
                $('input[name="zip_code"]').removeAttr('disabled');
                $('input[name="country"]').removeAttr('disabled');
            });
        });
    </script>
@endpush
