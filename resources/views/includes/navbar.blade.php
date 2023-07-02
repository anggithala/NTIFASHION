    <nav class="navbar navbar-expand-lg navbar-light navbar-store sticky-top navbar-fixed-top mt-2" data-aos="fade-down">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="/images/logo.svg" alt="Logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle 'active' : '' }}" href="#" id="navbarDropdownMenuLink"
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
                        <a class="nav-link " href="{{ route('contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('faq') ? 'active' : '' }}">
                        <a class="nav-link " href="{{ route('faq') }}">FAQ</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="btn btn-success nav-link px-4 text-white" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                </ul>
                @auth
                    <ul class="navbar-nav d-none d-lg-flex ml-auto">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex justify-content-center align-items-center"
                                id="navbarDropdown" role="button" data-toggle="dropdown">
                                <div class="rounded-circle mr-2"
                                    style="width: 48px; height: 48px; background-image: url({{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '/images/icon-user.png' }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                </div>
                                Hi, {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('dashboard-transactions') }}" class="dropdown-item">Dashboard</a>
                                <a href="{{ route('dashboard-setting-account') }}" class="dropdown-item">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>

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
