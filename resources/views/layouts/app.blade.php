<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Welcome')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity=""
        crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar')

    <div class="site-container">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity=""
        crossorigin="anonymous"></script>
    <script>
        // Smooth scrolling for in-page anchors
        document.addEventListener('click', function(e) {
            const target = e.target.closest('a[href^="#"]');
            if (!target) return;
            const href = target.getAttribute('href');
            if (href.length > 1) {
                e.preventDefault();
                const el = document.querySelector(href);
                if (el) el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });

        // Add subtle blur/opacity on navbar when scrolled
        const nav = document.querySelector('.navbar');
        const onScroll = () => {
            if (!nav) return;
            if (window.scrollY > 10) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        };
        onScroll();
        window.addEventListener('scroll', onScroll, {
            passive: true
        });
    </script>
</body>
</body>

</html>
