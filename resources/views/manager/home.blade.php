@extends('manager.navbar')

@section('title', 'Dashboard Manajer Gudang')

@section('content')
<header class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard Manajer Gudang</h1>
    </div>
</header>

<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold">Welcome, {{ auth()->user()->name }}!</h2>
    <p class="mb-4">Ringkasan informasi stok hari ini.</p>

    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <!-- Stok Menipis -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Stok Menipis</h3>
            <ul class="space-y-2">
                @forelse ($data['low_stock_products'] as $product)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm flex justify-between items-center">
                        <span class="font-semibold">{{ $product->name }}</span> - 
                        <span class="text-red-500">{{ $product->stock }} unit</span>
                    </li>
                @empty
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm text-gray-500">Tidak ada stok menipis.</li>
                @endforelse
            </ul>
        </div>

        <!-- Barang Masuk Hari Ini -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Masuk Hari Ini</h3>
            <ul class="space-y-2">
                @forelse ($data['incoming_stock_today'] as $transaction)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm flex justify-between items-center">
                        <span class="font-semibold">{{ $transaction->product->name }}</span> - 
                        <span>{{ $transaction->quantity }} unit</span>
                    </li>
                @empty
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm text-gray-500">Tidak ada barang masuk hari ini.</li>
                @endforelse
            </ul>
        </div>

        <!-- Barang Keluar Hari Ini -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Keluar Hari Ini</h3>
            <ul class="space-y-2">
                @forelse ($data['outgoing_stock_today'] as $transaction)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm flex justify-between items-center">
                        <span class="font-semibold">{{ $transaction->product->name }}</span> - 
                        <span>{{ $transaction->quantity }} unit</span>
                    </li>
                @empty
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm text-gray-500">Tidak ada barang keluar hari ini.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection