<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://kit.fontawesome.com/12df916f26.js" crossorigin="anonymous"></script>
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex aos-init aos-animate" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <img src="/images/logo.svg" alt="Logo" class="mb-4" />
                    </a>

                </div>
                <div class="list-group list-group-flush">
                    {{-- <a href="{{ route('dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a> --}}
                    <a href="{{ route('dashboard-transactions') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/transactions') ? 'active' : '' }}">
                        Transactions
                    </a>
                    <a href="{{ route('dashboard-setting-account') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/account') ? 'active' : '' }}">
                        Settings
                    </a>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Page Content -->
            <div id="page-content-wrapper">

                {{-- Navbar --}}
                <nav class="navbar navbar-expand-lg navbar-light navbar-store bg-white" data-aos="fade-down">
                    <div class="container mt-0">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarResponsive">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categories
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        @php
                                            $categories = \App\Models\Category::get(['name', 'slug']);
                                        @endphp
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item {{ request()->is('category/' . $category->slug) ? 'active' : '' }}"
                                                href="{{ url('category/' . $category->slug) }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </li>
                                <li class="nav-item {{ Request::routeIs('contact') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('faq') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('faq') }}">FAQ</a>
                                </li>

                                @guest
                                    <li class="nav-item">
                                        <a class="btn btn-success nav-link px-4 text-white"
                                            href="{{ route('login') }}">Login</a>
                                    </li>
                                @endguest
                            </ul>
                            @auth
                                <ul class="navbar-nav d-none d-lg-flex">
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link d-flex justify-content-center align-items-center"
                                            id="navbarDropdown" role="button" data-toggle="dropdown">
                                            <div class="rounded-circle mr-2"
                                                style="width: 48px; height: 48px; background-image: url({{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '/images/icon-user.png' }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                            </div>
                                            Hi, {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                            @php
                                                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                            @endphp
                                            @if ($carts > 0)
                                                <img src="/images/cart-filled.svg" alt="" />
                                                <div class="card-badge">{{ $carts }}</div>
                                            @else
                                                <img src="/images/cart-empty.svg" alt="" />
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav d-block d-lg-none">
                                    <li class="nav-item">
                                        <a href="{{ route('dashboard-transactions') }}" class="nav-link"> Hi,
                                            {{ Auth::user()->name }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('cart') }}" class="nav-link d-inline-block"> Cart </a>
                                    </li>
                                </ul>
                            @endauth
                        </div>
                    </div>
                </nav>

                {{-- Content --}}
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    @stack('addon-script')
</body>

</html>
