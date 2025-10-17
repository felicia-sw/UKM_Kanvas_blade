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
    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

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

        html, body {
            height: 100%;
            width: 100%;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Judson', serif;
            background: linear-gradient(to bottom, #FFEC77 0%, #8F4898 42%, #844191 45%, #68307E 50%, #3B1461 57%, #2A0A56 59%, #2A0A56 100%);
            background-attachment: fixed;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
        }

        /* Glass Card Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Page Header */
        .page-header {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        /* Button Styles */
        .btn-gradient {
            background: linear-gradient(135deg, #FFEC77 0%, #F8B803 50%, #FF750F 100%);
            border: none;
            color: #1b1b18;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 236, 119, 0.4);
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 236, 119, 0.6);
            color: #1b1b18;
        }

        .btn-outline-light {
            border: 2px solid #fff;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: #fff;
            transform: translateY(-2px);
        }

        /* Utility Classes */
        .text-white-50 {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #F8B803 0%, #FF750F 100%);
        }

        /* Loading Animation */
        .loading {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            body {
                font-size: 14px;
            }
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
    </script>

    @stack('scripts')
</body>
</html>track {
            background: #2A0A56;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #FFEC77 0%, #F8B803 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-