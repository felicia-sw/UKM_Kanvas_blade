<div class="sidebar d-flex flex-column p-3">
    {{-- Sidebar Header --}}
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none sidebar-brand">
        {{-- You might want a different logo or just text for admin --}}
        {{-- <img src="{{ asset('images/logo.png') }}" alt="Kanvas Logo" width="32" height="32" class="me-2"> --}}
        <span class="fs-4 fw-bold">KANVAS ADMIN</span>
    </a>
    <hr class="sidebar-divider">

    {{-- Navigation Links --}}
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-white' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('admin.artworks.index') }}"
               class="nav-link {{ request()->routeIs('admin.artworks.*') ? 'active' : 'text-white' }}">
                 <i class="bi bi-palette me-2"></i>
                Art Gallery & Doc
            </a>
        </li>
        {{-- Documentation link removed as it's combined above --}}
        <li class="nav-item mb-1">
            <a href="{{ route('admin.events.index') }}"
               class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-calendar-event me-2"></i>
                Events
            </a>
        </li>
        {{-- Add Content Management Link Later (commented out) --}}
        {{-- <li class="nav-item mb-1">
            <a href="#" class="nav-link text-white disabled"> 
                <i class="bi bi-file-text me-2"></i>
                Content Management
            </a>
        </li> --}}
    </ul>

    {{-- Divider before User/Logout --}}
    <hr class="sidebar-divider">

    {{-- User Dropdown / Logout --}}
    <div class="admin-logout-section">
        <form action="{{ route('logout') }}" method="POST" style="display: block;">
            @csrf
            <button type="submit" class="btn btn-logout w-100 text-start">
                <i class="bi bi-box-arrow-left me-2"></i>Logout
            </button>
        </form>
    </div>
</div>