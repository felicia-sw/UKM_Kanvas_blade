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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="loginEmail" class="form-label text-white-50">Email Address</label>
                            <input type="email" class="form-control contact-input" id="loginEmail" name="email"
                                required autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="loginPassword" class="form-label text-white-50">Password</label>
                            <input type="password" class="form-control contact-input" id="loginPassword" name="password"
                                required>
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- FIX 2: Remove the undefined 'modal-glass-body' class --}}
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="registerName" class="form-label text-white-50">Full Name</label>
                            <input type="text" class="form-control contact-input" id="registerName" name="name"
                                required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label text-white-50">Email Address</label>
                            <input type="email" class="form-control contact-input" id="registerEmail" name="email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label text-white-50">Password</label>
                            <input type="password" class="form-control contact-input" id="registerPassword"
                                name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="registerConfirmPassword" class="form-label text-white-50">Confirm
                                Password</label>
                            <input type="password" class="form-control contact-input" id="registerConfirmPassword"
                                name="password_confirmation" required>
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
