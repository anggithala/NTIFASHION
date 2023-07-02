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
    <link href="/style/main.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.css" rel="stylesheet" />

    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex aos-init aos-animate" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/logo.svg" alt="" class="my-4" />
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ Route('owner-dashboard') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('owner') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('pelanggan.index') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('owner/pelanggan') ? 'active' : '' }}">
                        Users
                    </a>
                    <a href="{{ route('transaksi.index') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('owner/transaksi') ? 'active' : '' }}">
                        Transactions
                    </a>
                    <a href="{{ route('jual.index') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('owner/jual') ? 'active' : '' }}">
                        Offline Transactions
                    </a>
                    <a href="{{ route('ulasan.index') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('owner/ulasan') ? 'active' : '' }}">
                        Reviews
                    </a>
                    <a href="{{ route('owner.setting') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('owner/setting') ? 'active' : '' }}">
                        Settings
                    </a>


                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!--Desktop Menu-->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        <img src="{{ asset(!Auth::user()->avatar ? '/images/icon-user.png' : 'storage/' . Auth::user()->avatar) }}"
                                            alt="Avatar" class="rounded-circle mr-2 profile-picture" />
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
                            </ul>
                        </div>
                    </div>
                </nav>

                {{-- Content --}}
                @yield('content')
            </div>
        </div>
    </div>

    @stack('outside')
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
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
