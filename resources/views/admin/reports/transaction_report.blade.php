@extends('admin.navbar')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Laporan Stok</h2>

    <!-- Filter -->
    <form action="{{ route('admin.reports.transaction_report') }}" method="GET" class="mb-6 flex flex-wrap gap-4 justify-center">
        <select name="category_id" class="border rounded p-2">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <select name="supplier_id" class="border rounded p-2">
            <option value="">-- Pilih Supplier --</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
            @endforeach
        </select>

        <select name="stock_order" class="border rounded p-2">
            <option value="">-- Urutkan Stok --</option>
            <option value="asc" {{ request('stock_order') == 'asc' ? 'selected' : '' }}>Terkecil</option>
            <option value="desc" {{ request('stock_order') == 'desc' ? 'selected' : '' }}>Terbanyak</option>
        </select>

        <select name="price_order" class="border rounded p-2">
            <option value="">-- Urutkan Harga --</option>
            <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>Termurah</option>
            <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>Termahal</option>
        </select>

        <select name="transaction_order" class="border rounded p-2">
            <option value="">-- Urutkan Transaksi --</option>
            <option value="asc" {{ request('transaction_order') == 'asc' ? 'selected' : '' }}>Paling Sedikit</option>
            <option value="desc" {{ request('transaction_order') == 'desc' ? 'selected' : '' }}>Paling Banyak</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Nama Produk</th>
                    <th class="py-3 px-6 text-left">Kategori</th>
                    <th class="py-3 px-6 text-left">Supplier</th>
                    <th class="py-3 px-6 text-left">SKU</th>
                    <th class="py-3 px-6 text-right">Harga Beli</th>
                    <th class="py-3 px-6 text-right">Harga Jual</th>
                    <th class="py-3 px-6 text-right">Stok Saat Ini</th>
                    <th class="py-3 px-6 text-right">Stok Minimum</th>
                    <th class="py-3 px-6 text-left">Atribut</th>
                    <th class="py-3 px-6 text-right">Total Masuk</th>
                    <th class="py-3 px-6 text-right">Total Keluar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="py-4 px-6">{{ $product->product_name }}</td>
                        <td class="py-4 px-6">{{ $product->category_name }}</td>
                        <td class="py-4 px-6">{{ $product->supplier_name }}</td>
                        <td class="py-4 px-6">{{ $product->sku }}</td>
                        <td class="py-4 px-6 text-right">Rp {{ number_format($product->purchase_price, 2) }}</td>
                        <td class="py-4 px-6 text-right">Rp {{ number_format($product->selling_price, 2) }}</td>
                        <td class="py-4 px-6 text-right">{{ $product->current_stock }}</td>
                        <td class="py-4 px-6 text-right">{{ $product->minimum_stock }}</td>
                        <td class="py-4 px-6">{{ $product->attributes }}</td>
                        <td class="py-4 px-6 text-right">{{ $product->total_in }}</td>
                        <td class="py-4 px-6 text-right">{{ $product->total_out }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
