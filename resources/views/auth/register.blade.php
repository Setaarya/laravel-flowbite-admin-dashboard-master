@php
    $settings = \App\Models\Setting::first();
@endphp


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ $settings->app_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800">Daftar Akun {{ $settings->app_name }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-300 p-3 mt-4 rounded">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama:</label>
                <input type="text" id="name" name="name" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role:</label>
                <select id="role" name="role" required
                        class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                    <option value="Admin">Admin</option>
                    <option value="Staff Gudang">Staff Gudang</option>
                    <option value="Manajer Gudang">Manager Gudang</option>
                </select>
            </div>

            <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300">
                Daftar
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-gray-700">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                    Login di sini
                </a>
            </p>
        </div>
    </div>

</body>
</html>
