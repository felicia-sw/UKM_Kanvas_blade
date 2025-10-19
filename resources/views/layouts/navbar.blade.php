<nav class="navbar navbar-expand-lg navbar-dark bg-glass shadow-lg px-3 p-lg-4 site-navbar-fixed">
    <div class="container-fluid">
        <!-- Logo/Brand -->
        <a class="navbar-brand fs-3 fs-lg-2 fw-bold text-white d-flex align-items-center"
            href="{{ route('home') }}">
            <img src="{{ asset('images/logo_putih.png') }}" alt="{{ config('app.name') }} logo" class="navbar-logo">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
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
                    <a class="nav-link text-white px-3 py-2 rounded-3 {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        <i class="bi bi-envelope me-2"></i>Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
