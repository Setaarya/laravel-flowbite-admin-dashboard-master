@php
    $settings = \App\Models\Setting::first();
@endphp


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->app_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-blue-700 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-4">
            <div class="text-center py-10">
                @if($settings->app_logo)
                    <img src="{{ asset('storage/' . $settings->app_logo) }}" class="mx-auto h-24 mb-4">
                @endif
                <h1 class="text-3xl font-bold">{{ $settings->app_name }}</h1>
            </div>
            <nav class="flex space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition">Register</a>
                <a href="{{ route('password.request') }}" class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition">Forgot Password</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto flex items-center justify-center h-[80vh]">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-gray-800">Selamat Datang di {{ $settings->app_name }}</h1>
            <p class="text-lg text-gray-600 mt-4">Kelola stok barang Anda dengan mudah dan efisien.</p>
        </div>
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; 2025 {{ $settings->app_name }}. All rights reserved.</p>
    </footer>
</body>
</html>
