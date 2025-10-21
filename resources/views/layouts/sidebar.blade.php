<div class="sidebar d-flex flex-column p-3">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none sidebar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Kanvas Logo" width="32" height="32" class="me-2">
        <span class="fs-4 fw-bold">KANVAS ADMIN</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-white' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.artworks.index') }}" class="nav-link {{ request()->routeIs('admin.artworks.*') ? 'active' : 'text-white' }}">
                 <i class="bi bi-palette me-2"></i>
                Art Gallery
            </a>
        </li>
         <li>
            <a href="{{ route('admin.documentation.index') }}" class="nav-link {{ request()->routeIs('admin.documentation.*') ? 'active' : 'text-white' }}">
                 <i class="bi bi-images me-2"></i>
                Documentation
            </a>
        </li>
        <li>
            <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : 'text-white' }}">
                <i class="bi bi-calendar-event me-2"></i>
                Events
            </a>
        </li>
        {{-- Add other links like Content Management later --}}
        {{-- <li>
            <a href="#" class="nav-link text-white">
                <i class="bi bi-file-text me-2"></i>
                Content Management
            </a>
        </li> --}}
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-4 me-2"></i>
            <strong>Admin</strong> {{-- Replace with Auth::user()->name later --}}
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            {{-- <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li> --}}
             <li>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>