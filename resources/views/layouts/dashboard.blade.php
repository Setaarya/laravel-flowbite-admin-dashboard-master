<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-blue-700 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold">Stockify</h1>
            <nav class="flex space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition">Register</a>
                <a href="{{ route('password.request') }}" class="px-4 py-2 bg-gray-700 rounded-md hover:bg-gray-600 transition">Forgot Password</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto flex items-center justify-center h-[80vh]">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-gray-800">Selamat Datang di Stockify</h1>
            <p class="text-lg text-gray-600 mt-4">Kelola stok barang Anda dengan mudah dan efisien.</p>
        </div>
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; 2025 Stockify. All rights reserved.</p>
    </footer>
</body>
</html>
