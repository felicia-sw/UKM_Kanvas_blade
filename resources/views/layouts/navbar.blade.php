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
                <p class="text-white-50 fs-2 mb-0">UKM Kanvas</p>   

                <!-- mobile burger -->
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- nav  links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto gap-2 gap-lg-3 mt-3 mt-lg-0">
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
                                <i class="bi bi-info-circle me-2"></i>Merchandise
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">
                                <i class="bi bi-envelope me-2"></i>Contact
                            </a>
                        </li>
                    </ul>
                    {{-- login and register here --}}
                    <div class="d-flex flex-column flex-lg-row ms-auto ms-lg-0 gap-2 mt-3 mt-lg-0">
                        @auth
                            {{-- Show user name and logout when authenticated --}}
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-light px-4 py-2 dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    @if(Auth::user()->is_admin)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                                <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
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
                            <button class="btn btn-sm btn-outline-light px-4 py-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </button>
                            <button class="btn btn-sm btn-gradient px-4 py-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="bi bi-person-plus-fill me-1"></i>Register
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>
{{-- </div> --}}

<style>
    .bg-glass {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .navbar-logo {
        height: 42px; 
        width: auto;
        object-fit: contain;
        margin-right: 0.5rem;
    }

     /* .site-navbar-fixed {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1080;   
         margin: 0 auto;
        border-radius: 0;     
        box-sizing: border-box;
        padding: 0; 
    } */

    .site-navbar-fixed {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1080;   
    margin: 0;          /* Change from 'auto' to '0' */
    border-radius: 0;     
    box-sizing: border-box;
    padding: 1rem 1.5rem; /* Add padding directly to navbar instead */
}

    .nav-link {
        font-size: 18px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link i {
        font-size: 16px;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
        transform: translateY(-2px);
    }

    .nav-link.active {
        background: linear-gradient(135deg, rgba(255, 236, 119, 0.3) 0%, rgba(248, 184, 3, 0.3) 100%);
        border: 1px solid rgba(255, 236, 119, 0.5);
        font-weight: 600;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-collapse {
        transition: all 0.3s ease;
    }

    @media (max-width: 991px) {
        .navbar-nav {
            padding-top: 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            padding: 0.75rem 1rem !important;
        }
    }

       .navbar-nav {
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .navbar-nav .nav-item { flex: 0 0 auto; }

    .navbar-nav .nav-link { white-space: nowrap; }

    /* Dropdown menu styling */
    .dropdown-menu {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(248, 184, 3, 0.1);
        transform: translateX(5px);
    }

    .dropdown-item.text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }
</style>
