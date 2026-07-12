<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UKM Kanvas') }} - @yield('title', 'Welcome')</title>

    <!-- Favicon / App Icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    @include('layouts.navbar')

    <div class="site-container">
        @yield('content')
    </div>

    {{-- 💡 LOGIN MODAL (POP-UP) --}}
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            {{-- FIX 1: Use the defined 'glass-card' class instead of 'modal-glass-content' --}}
            <div class="modal-content glass-card">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title text-white fw-bold" id="loginModalLabel">Login to Your Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- FIX 2: Remove the undefined 'modal-glass-body' class --}}
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> Please fix the following errors:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="loginEmail" class="form-label text-white-50">Email Address</label>
                            <input type="email"
                                class="form-control contact-input @error('email') is-invalid @enderror" id="loginEmail"
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="loginPassword" class="form-label text-white-50">Password</label>
                            <input type="password"
                                class="form-control contact-input @error('password') is-invalid @enderror"
                                id="loginPassword" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gradient w-100 py-2">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </form>
                    <p class="text-center text-white-50 mt-3 mb-0 small">
                        Don't have an account?
                        <a href="#" class="text-warning text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#registerModal" data-bs-dismiss="modal">
                            Register here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- 💡 REGISTER MODAL (POP-UP) --}}
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            {{-- FIX 1: Use the defined 'glass-card' class instead of 'modal-glass-content' --}}
            <div class="modal-content glass-card">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title text-white fw-bold" id="registerModalLabel">Create a New Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- FIX 2: Remove the undefined 'modal-glass-body' class --}}
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> Please fix the following errors:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="registerName" class="form-label text-white-50">Full Name</label>
                            <input type="text"
                                class="form-control contact-input @error('name') is-invalid @enderror"
                                id="registerName" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label text-white-50">Email Address</label>
                            <input type="email"
                                class="form-control contact-input @error('email') is-invalid @enderror"
                                id="registerEmail" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label text-white-50">Password</label>
                            <input type="password"
                                class="form-control contact-input @error('password') is-invalid @enderror"
                                id="registerPassword" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="registerConfirmPassword" class="form-label text-white-50">Confirm
                                Password</label>
                            <input type="password"
                                class="form-control contact-input @error('password_confirmation') is-invalid @enderror"
                                id="registerConfirmPassword" name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gradient w-100 py-2">
                            <i class="bi bi-person-plus-fill me-2"></i>Register
                        </button>
                    </form>
                    <p class="text-center text-white-50 mt-3 mb-0 small">
                        Already have an account?
                        <a href="#" class="text-warning text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#loginModal" data-bs-dismiss="modal">
                            Login here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/layout.js') }}"></script>
    @if ($errors->any())
        <script>
            // Automatically show the register modal when validation failed
            document.addEventListener('DOMContentLoaded', function() {
                var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                registerModal.show();
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>
