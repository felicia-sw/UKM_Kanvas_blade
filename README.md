# UKM Kanvas Blade - Laravel Application

A modern Laravel application with Blade templating, featuring a beautiful and responsive user interface.

## 🚀 Features

- **Laravel Framework** - Latest Laravel with modern PHP features
- **Blade Templates** - Elegant templating engine with component-based architecture
- **Responsive Design** - Modern, mobile-first design that works on all devices
- **SQLite Database** - Lightweight database for development and testing
- **Beautiful UI** - Gradient backgrounds, glassmorphism effects, and modern styling

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- SQLite (included with PHP)

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd UKM_Kanvas_blade
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🌐 Usage

Once the server is running, visit:
- **Home**: http://localhost:8000
- **About**: http://localhost:8000/about
- **Contact**: http://localhost:8000/contact

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   └── Models/           # Eloquent models
├── resources/
│   └── views/            # Blade templates
│       ├── layouts/      # Layout templates
│       ├── home.blade.php
│       ├── about.blade.php
│       └── contact.blade.php
├── routes/
│   └── web.php           # Web routes
├── database/
│   ├── migrations/       # Database migrations
│   └── database.sqlite   # SQLite database
└── public/               # Public assets
```

## 🎨 Blade Templates

This project demonstrates Laravel's Blade templating engine with:

- **Layout inheritance** - Base layout with sections
- **Component-based design** - Reusable template components
- **Modern styling** - CSS Grid, Flexbox, and modern design patterns
- **Responsive design** - Mobile-first approach

## 🔧 Development

### Available Routes

- `GET /` - Home page
- `GET /about` - About page  
- `GET /contact` - Contact page

### Key Files

- `resources/views/layouts/app.blade.php` - Main layout template
- `resources/views/home.blade.php` - Home page template
- `resources/views/about.blade.php` - About page template
- `resources/views/contact.blade.php` - Contact page template
- `routes/web.php` - Application routes

## 📱 Features Demonstrated

- **Template Inheritance** - Using `@extends` and `@section`
- **Blade Components** - Reusable template parts
- **Route Naming** - Named routes with `route()` helper
- **Asset Management** - CSS and JavaScript integration
- **Responsive Design** - Mobile-friendly layouts

## 🚀 Next Steps

- Add authentication system
- Implement user management
- Add database models and relationships
- Create API endpoints
- Add testing suite
- Implement caching strategies

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).