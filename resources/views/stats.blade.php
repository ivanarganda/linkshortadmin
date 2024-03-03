@extends('dashboard')

@section('title','Stats')

@section('main-content')

    <main class="flex justify-between items-center mt-16 mb-6">
        <h1 class="text-2xl font-semibold text-gray-600">Stats of shorts and users</h1>
        <input
            class="flex h-10 outline-none rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-64"
            placeholder="Filter users..."
            type="search"
        />
    </main>
    
@endsection