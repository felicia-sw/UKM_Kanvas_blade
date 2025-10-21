<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - UKM Kanvas</title>
    <link href="[https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css](https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css)" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="admin-login-body d-flex align-items-center justify-content-center">

    <div class="login-card p-4 p-md-5">
         <div class="text-center mb-4">
             <img src="{{ asset('images/logo.png') }}" alt="Kanvas Logo" width="60" height="60" class="mb-2">
            <h1 class="h3 mb-3 fw-bold text-white">KANVAS ADMIN LOGIN</h1>
         </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
         @if (session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('status') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label text-white-50" for="remember">
                    Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-admin-primary" type="submit">Login</button>
        </form>
    </div>

    <script src="[https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js](https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js)"></script>
</body>
</html>