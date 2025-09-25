<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKfXMz_K2WzIYEAAoc7xPIncyoKHsI230WCA&s">
    <title>@yield('title','App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
        }
        .navbar-custom .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #fff !important;
        }
        .navbar-custom .nav-link,
        .navbar-custom .btn {
            color: #fff !important;
        }
        .navbar-custom .btn-outline-light {
            border-color: #fff;
        }
    </style>
</head>
<body>

{{-- ✅ header include --}}
@if(Route::is('login'))

@else
    @include('layouts.header')
@endif

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
