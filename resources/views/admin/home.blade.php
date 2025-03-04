@extends('admin.navbar')

@section('title', 'Dashboard Admin Gudang')

@section('content')
<header class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard Admin Gudang</h1>
    </div>
</header>

<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold">Welcome, {{ auth()->user()->name }}!</h2>
    <p class="mb-4">Ringkasan informasi stok dan transaksi terbaru.</p>

    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <!-- Total Produk -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Total Produk</h3>
            <p class="text-2xl font-bold">{{ $data['total_products'] }}</p>
        </div>

        <!-- Transaksi Barang Masuk -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Masuk</h3>
            <p class="text-2xl font-bold">{{ $data['incoming_transactions'] }}</p>
        </div>

        <!-- Transaksi Barang Keluar -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Keluar</h3>
            <p class="text-2xl font-bold">{{ $data['outgoing_transactions'] }}</p>
        </div>

    
        <!-- Total Transaksi -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-gray-600 font-semibold">Total Transaksi</h3>
            <p class="text-2xl font-bold text-green-600">{{ $data['total_transactions'] }}</p>
        </div>
    
        <!-- Total Supplier -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-gray-600 font-semibold">Total Supplier</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $data['total_suppliers'] }}</p>
        </div>
    
        <!-- Total Pengguna -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-gray-600 font-semibold">Total Pengguna</h3>
            <p class="text-2xl font-bold text-purple-600">{{ $data['total_users'] }}</p>
        </div>
    
        <!-- Produk Stok Minimum -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-gray-600 font-semibold">Stok Habis</h3>
            <p class="text-2xl font-bold text-red-600">{{ $data['low_stock'] }}</p>
        </div>
    </div>

    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <!-- Grafik Stok -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Grafik Level Stok</h3>
            <canvas id="stockLevelsChart"></canvas>
        </div>

        <!-- Aktivitas Pengguna Terbaru -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Aktivitas Pengguna Terbaru</h3>
            <ul class="space-y-2">
                @forelse ($data['latest_user_activities'] as $activity)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm">
                        <span class="font-semibold">{{ $activity->name }}</span> - 
                        <span class="text-gray-500 text-sm">{{ $activity->created_at->format('d M Y, H:i') }}</span>
                    </li>
                @empty
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm text-gray-500">Tidak ada aktivitas terbaru.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stockLevelsChart').getContext('2d');
    const stockLevelsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($data['stock_levels']->pluck('name')) !!},
            datasets: [{
                label: 'Stock Levels',
                data: {!! json_encode($data['stock_levels']->pluck('current_stock')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
