<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @auth
            @yield('title') 
        @else
            Login
        @endauth
    </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="flex flex-col mx-auto">
        @include('layouts/header')
        <div class="flex flex-1">
            @include('layouts/sidebar')
            @auth
                @include('layouts/main-content')
            @else
                @include('form/login')
            @endauth
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>