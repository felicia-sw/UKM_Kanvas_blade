<div class="container-fluid px-5 py-3">
    <header class="mb-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-glass rounded-4 shadow-lg p-3 sticky-top z-3">
            <div class="container-fluid">
                <a class="navbar-brand fs-4 fw-semibold text-white" href="{{ route('home') }}">
                    {{ config('app.name') }}
                </a>

                {{-- buat mobile --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto gap-3">
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-2 fs-2"
                                href="{{ route('home') }}#features">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-2 fs-2"
                                href="{{ route('home') }}#events">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-2 fs-2"
                                href="{{ route('home') }}#gallery">Art Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-2 fs-2"
                                href="{{ route('home') }}#about">About
                                Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 py-2 rounded-2 fs-2"
                                href="{{ route('home') }}#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
