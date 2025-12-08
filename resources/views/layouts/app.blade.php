<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UKM Kanvas') }} - @yield('title', 'Welcome')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        html {
            min-height: 100%;
            width: 100%;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Judson', serif;
            /* spy gradient spans entire page height */
            background: linear-gradient(to bottom, #FFEC77 0%, #F7D86A 15%, #D88FC6 40%, #9A4CA0 60%, #5B2066 80%, #2A0A56 100%);
            background-attachment: scroll;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            min-height: 100vh;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }


        .page-header {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
    </style>

    @stack('styles')
</head>

<body>
    @include('layouts.navbar')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; max-width: 500px;" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; max-width: 500px;" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="site-container">
        @yield('content')
    </div>

    <!-- Notification Toast Container (Right Side) -->
    @auth
        @if (Auth::user()->unreadCustomNotifications()->count() > 0)
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; margin-top: 100px;">
                <div id="notificationToast" class="toast show" role="alert"
                    style="background: #2A0A56; border: 1px solid #8F4898; max-width: 350px;">
                    <div class="toast-header" style="background: #8F4898; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <i class="bi bi-bell-fill text-warning me-2"></i>
                        <strong class="me-auto text-white">Notifications</strong>
                        <small class="text-white-50">{{ Auth::user()->unreadCustomNotifications()->count() }} new</small>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body text-white" style="max-height: 400px; overflow-y: auto;">
                        @foreach (Auth::user()->unreadCustomNotifications()->latest()->take(3)->get() as $notification)
                            <div class="mb-2 pb-2 border-bottom border-secondary">
                                <small
                                    class="text-warning">{{ ucfirst(str_replace('_', ' ', $notification->type)) }}</small>
                                <p class="mb-1 small">{{ Str::limit($notification->message, 80) }}</p>
                                <small class="text-white-50">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                        <a href="{{ route('profile.profile') }}#notifications"
                            class="btn btn-sm btn-warning text-dark w-100 mt-2">
                            <i class="bi bi-eye me-1"></i>View All
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endauth

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
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
        aria-hidden="true">
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
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Automatically show modal if there are validation errors
            @if ($errors->any())
                var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                registerModal.show();
            @endif
        });

        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // spy bisa gradient span entire page height
        function updateGradientHeight() {
            const body = document.body;
            const html = document.documentElement;
            const height = Math.max(
                body.scrollHeight,
                body.offsetHeight,
                html.clientHeight,
                html.scrollHeight,
                html.offsetHeight
            );
            body.style.backgroundSize = `100% ${height}px`;
        }

        // update on load and resize
        window.addEventListener('load', updateGradientHeight);
        window.addEventListener('resize', updateGradientHeight);

        // kasih short delayto update 
        setTimeout(updateGradientHeight, 100);
    </script>

    @stack('scripts')
</body>

</html>
