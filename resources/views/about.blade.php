@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="about-section">
    <h1>About {{ config('app.name') }}</h1>
    
    <div class="card">
        <h2>Our Mission</h2>
        <p>We are dedicated to creating exceptional web applications using modern technologies and best practices. Our Laravel-based platform provides a solid foundation for building scalable and maintainable web solutions.</p>
    </div>

    <div class="card">
        <h2>Technology Stack</h2>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 10px; background: #f8f9fa; margin: 5px 0; border-radius: 5px;">
                <strong>Laravel {{ app()->version() }}</strong> - PHP Framework
            </li>
            <li style="padding: 10px; background: #f8f9fa; margin: 5px 0; border-radius: 5px;">
                <strong>Blade Templates</strong> - Templating Engine
            </li>
            <li style="padding: 10px; background: #f8f9fa; margin: 5px 0; border-radius: 5px;">
                <strong>SQLite</strong> - Database
            </li>
            <li style="padding: 10px; background: #f8f9fa; margin: 5px 0; border-radius: 5px;">
                <strong>PHP {{ PHP_VERSION }}</strong> - Programming Language
            </li>
        </ul>
    </div>

    <div class="card">
        <h2>Features</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
            <div>
                <h4>🔧 MVC Architecture</h4>
                <p>Clean separation of concerns with Model-View-Controller pattern.</p>
            </div>
            <div>
                <h4>🗄️ Database Integration</h4>
                <p>Seamless database operations with Eloquent ORM.</p>
            </div>
            <div>
                <h4>🎨 Modern UI</h4>
                <p>Beautiful, responsive user interface with modern design principles.</p>
            </div>
            <div>
                <h4>⚡ Performance</h4>
                <p>Optimized for speed and efficiency with caching and optimization.</p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('home') }}" class="btn">Back to Home</a>
        <a href="{{ route('contact') }}" class="btn" style="margin-left: 10px;">Contact Us</a>
    </div>
</div>
@endsection
