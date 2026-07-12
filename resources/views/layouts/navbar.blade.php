<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

{{-- <div class="container-fluid px-4 px-lg-5 py-3">
    <header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-glass rounded-4 shadow-lg p-3 p-lg-4 site-navbar-fixed"> --}}
<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-glass shadow-lg p-3 p-lg-4 site-navbar-fixed">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} logo" class="navbar-logo">
                <span class="visually-hidden">{{ config('app.name') }}</span>
            </a>
            <p class="text-white-50 mb-0 navbar-brand-text">UKM Kanvas</p>

            <!-- mobile burger -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- nav  links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-1 gap-lg-1 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">
                            <i class="bi bi-house-door me-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('events') ? 'active' : '' }}"
                            href="{{ route('events') }}">
                            <i class="bi bi-calendar-event me-2"></i>Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('art_gallery') ? 'active' : '' }}"
                            href="{{ route('art_gallery') }}">
                            <i class="bi bi-palette me-2"></i>Art Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-2"></i>About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('merchandise') ? 'active' : '' }}"
                            href="{{ route('merchandise') }}">
                            <i class="bi bi-bag me-2"></i>Merchandise
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('cart.*') ? 'active' : '' }}"
                                href="{{ route('cart.index') }}">
                                <i class="bi bi-cart me-2"></i>Cart
                                @php
                                    $cartCount = Auth::user()->shoppingCart
                                        ? Auth::user()->shoppingCart->items()->count()
                                        : 0;
                                @endphp
                                @if ($cartCount > 0)
                                    <span class="badge bg-warning text-dark ms-1">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                    @endauth
                </ul>
                {{-- login and register here --}}
                <div class="d-flex flex-column flex-lg-row ms-auto ms-lg-0 gap-2 mt-3 mt-lg-0">
                    @auth
                        {{-- Show user name and logout when authenticated --}}
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-light px-4 py-2 dropdown-toggle" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="bi bi-person me-2"></i>My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="bi bi-receipt me-2"></i>My Orders
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @if (Auth::user()->hasRole('Admin'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        {{-- Show login and register buttons when not authenticated --}}
                        <button class="btn btn-sm btn-outline-light px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </button>
                        <button class="btn btn-sm btn-gradient px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                            <i class="bi bi-person-plus-fill me-1"></i>Register
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
{{-- </div> --}}

<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
