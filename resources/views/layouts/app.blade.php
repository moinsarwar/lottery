<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKfXMz_K2WzIYEAAoc7xPIncyoKHsI230WCA&s">
    <title>@yield('title','App')</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>

{{-- ✅ header include --}}
@if(Route::is('login'))
@else
    @include('layouts.header')
@endif

<main class="container py-4">
    @yield('content')
</main>

<footer>
    <div class="container">
        <p>&copy; <span id="year"></span> Paradise Lottery. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('js/dashboard.js') }}?v={{ time() }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@yield('scripts')
</body>
</html>
