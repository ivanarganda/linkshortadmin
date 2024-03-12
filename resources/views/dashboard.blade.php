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
    <div class="flex flex-col mx-auto min-w-[350px]">
        @include('layouts/header')
        <div class="flex justify-center min-w-[350px]">
            @include('layouts/sidebar')
            @auth
                @include('layouts/rightSidebar')
                @include('layouts/main-content')
            @else
                @include('form/login')
            @endauth
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>