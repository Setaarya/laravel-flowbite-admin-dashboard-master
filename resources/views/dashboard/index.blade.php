<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')Stockify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #1a202c;
            color: white;
            height: 100vh;
            position: fixed;
        }

        .content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 1.5rem;
        }

        .header {
            background-color: #3182ce;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer {
            background-color: #2d3748;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        @include('dashboard.navbar')
    </aside>

    <div class="content">
        <header class="header">
            <h1 class="text-2xl font-bold">@yield('page_title')</h1>
        </header>

        <main class="mt-4">
            @yield('content')
            <div class="container mx-auto px-4 py-6">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
            
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Total Produk -->
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-gray-600 font-semibold">Total Produk</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $summary['total_products'] }}</p>
                    </div>
            
                    <!-- Total Transaksi -->
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-gray-600 font-semibold">Total Transaksi</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $summary['total_transactions'] }}</p>
                    </div>
            
                    <!-- Total Supplier -->
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-gray-600 font-semibold">Total Supplier</h3>
                        <p class="text-2xl font-bold text-yellow-600">{{ $summary['total_suppliers'] }}</p>
                    </div>
            
                    <!-- Total Pengguna -->
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-gray-600 font-semibold">Total Pengguna</h3>
                        <p class="text-2xl font-bold text-purple-600">{{ $summary['total_users'] }}</p>
                    </div>
            
                    <!-- Produk Stok Minimum -->
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-gray-600 font-semibold">Stok Minimum</h3>
                        <p class="text-2xl font-bold text-red-600">{{ $summary['low_stock'] }}</p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <p>&copy; 2025 Stockify. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
