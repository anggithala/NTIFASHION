<div class="page-dashboard">
    <div class="d-flex aos-init aos-animate" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
                <img src="/images/logo.svg" alt="" class="my-4" />
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                    Dashboard
                </a>
                <a href="{{ route('dashboard-transactions') }}" class="list-group-item list-group-item-action">
                    Transactions
                </a>
                <a href="{{ route('dashboard-setting-account') }}" class="list-group-item list-group-item-action">
                    My Account
                </a>
                <a href="/index.html" class="list-group-item list-group-item-action">
                    Sign Out
                </a>
            </div>
        </div>

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
                                    <img src="/images/icon-user.png" alt=""
                                        class="rounded-circle mr-2 profile-picture" />Hi, Anggi
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                    <a href="{{ route('dashboard-setting-store') }}" class="dropdown-item">Settings</a>
                                    <div class="dropdrown-divider">
                                        <a href="/" class="dropdown-item">Logout</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link d-inline-block mt-2">
                                    <img src="/images/cart-filled.svg" alt="" />
                                    <div class="card-badge">3</div>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav d-block d-lg-none">
                            <li class="nav-item">
                                <a href="#" class="nav-link"> Hi, Anggi </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link d-inline-block"> Cart </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
