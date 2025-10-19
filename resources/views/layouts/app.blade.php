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
        window.addEventListener('load', () => {
            updateGradientHeight();
            // Update again after a longer delay to ensure all content is loaded
            setTimeout(updateGradientHeight, 500);
            setTimeout(updateGradientHeight, 1000);
        });
        
        window.addEventListener('resize', updateGradientHeight);
        
        // Update when content changes (for dynamic pages)
        const observer = new MutationObserver(() => {
            setTimeout(updateGradientHeight, 100);
        });
        observer.observe(document.body, { 
            childList: true, 
            subtree: true,
            attributes: true 
        });
        
        // Force update on scroll events (for lazy-loaded content)
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(updateGradientHeight, 200);
        }, { passive: true });
    </script>

    @stack('scripts')
</body>

</html>
