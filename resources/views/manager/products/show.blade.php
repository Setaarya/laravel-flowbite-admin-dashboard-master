@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('manager.navbar')

@section('title', 'Detail Produk')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-4">Detail Produk</h1>

        <!-- Gambar Produk -->
        <div class="flex justify-center mb-4">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="max-w-lg w-full rounded-lg shadow-lg border border-gray-300">
            @else
                <p class="text-gray-500">No Image Available</p>
            @endif
        </div>

        <!-- Tabel Informasi Produk -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">ID</th>
                        <td class="px-4 py-2">{{ $product->id }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Nama</th>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">SKU</th>
                        <td class="px-4 py-2">{{ $product->sku }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Kategori</th>
                        <td class="px-4 py-2">{{ optional($product->category)->name ?? 'No Category' }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Supplier</th>
                        <td class="px-4 py-2">{{ optional($product->supplier)->name ?? 'No Supplier' }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Deskripsi</th>
                        <td class="px-4 py-2">{{ $product->description ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Harga Beli</th>
                        <td class="px-4 py-2">Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Harga Jual</th>
                        <td class="px-4 py-2">Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2 bg-gray-200">Stok Saat Ini</th>
                        <td class="px-4 py-2">{{ $product->current_stock }}</td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 bg-gray-200">Stok Minimum</th>
                        <td class="px-4 py-2">{{ $product->minimum_stock }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tabel Atribut Produk -->
        @if (($product->attributes ?? collect())->count() > 0)
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">Atribut Produk</h2>
            <table class="w-full border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="text-left px-4 py-2">Atribut</th>
                        <th class="text-left px-4 py-2">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->attributes as $attribute)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $attribute->name }}</td>
                        <td class="px-4 py-2">{{ $attribute->value }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 mt-4">Tidak ada atribut yang tersedia.</p>
        @endif
    </div>
</div>
@endsection