<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UKM Kanvas') }} - @yield('title', 'Welcome')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* Global Styles */
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
            /* Gradient spans entire page height */
            background: linear-gradient(to bottom, #FFEC77 0%, #F7D86A 15%, #D88FC6 40%, #9A4CA0 60%, #5B2066 80%, #2A0A56 100%);
            background-attachment: scroll;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }


        /* Page Header */
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

    @include('layouts.footer')

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Make gradient span entire page height
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

        // Update on load and resize
        window.addEventListener('load', updateGradientHeight);
        window.addEventListener('resize', updateGradientHeight);
        
        // Also update after a short delay to catch dynamic content
        setTimeout(updateGradientHeight, 100);
    </script>

    @stack('scripts')
</body>

</html>
