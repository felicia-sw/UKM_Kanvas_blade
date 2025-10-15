@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero">
    <h1>Welcome to {{ config('app.name') }}</h1>
    <p>A modern Laravel application with Blade templating</p>
    <a href="{{ route('about') }}" class="btn">Learn More</a>
</div>

<div class="features">
    <div class="card">
        <h3>🚀 Laravel Framework</h3>
        <p>Built with the latest Laravel framework for robust and scalable web applications.</p>
    </div>
    
    <div class="card">
        <h3>🎨 Blade Templates</h3>
        <p>Beautiful and maintainable templates using Laravel's Blade templating engine.</p>
    </div>
    
    <div class="card">
        <h3>📱 Responsive Design</h3>
        <p>Modern, responsive design that works perfectly on all devices and screen sizes.</p>
    </div>
</div>

<div class="stats">
    <h2>Project Statistics</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
        <div class="card">
            <h4>Laravel Version</h4>
            <p>{{ app()->version() }}</p>
        </div>
        <div class="card">
            <h4>PHP Version</h4>
            <p>{{ PHP_VERSION }}</p>
        </div>
        <div class="card">
            <h4>Environment</h4>
            <p>{{ app()->environment() }}</p>
        </div>
    </div>
</div>
@endsection
