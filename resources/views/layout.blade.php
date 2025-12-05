<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','FreelanceHub')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand text-primary fw-bold" href="{{ route('home') }}">FreelanceHub</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Services</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item me-2">Hello, {{ auth()->user()->name }}</li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">@csrf<button class="btn btn-outline-danger btn-sm">Logout</button></form>
          </li>
        @else
          <li class="nav-item"><a class="btn btn-outline-primary btn-sm me-2" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ url('/register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container py-5">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
