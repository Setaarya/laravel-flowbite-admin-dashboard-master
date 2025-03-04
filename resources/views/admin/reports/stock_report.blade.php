@extends('admin.navbar')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Laporan Transaksi Stok</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.stock_report') }}" class="mb-6 flex flex-wrap justify-center space-x-4">
        <select name="category_id" class="border border-gray-300 p-2 rounded">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        
        <input type="date" name="start_date" class="border border-gray-300 p-2 rounded" value="{{ $startDate }}">
        <input type="date" name="end_date" class="border border-gray-300 p-2 rounded" value="{{ $endDate }}">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Data Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Nama Produk</th>
                    <th class="py-3 px-6 text-left">Kategori</th>
                    <th class="py-3 px-6 text-left">Supplier</th>
                    <th class="py-3 px-6 text-left">SKU</th>
                    <th class="py-3 px-6 text-center">Harga Beli</th>
                    <th class="py-3 px-6 text-center">Harga Jual</th>
                    <th class="py-3 px-6 text-center">Stok Saat Ini</th>
                    <th class="py-3 px-6 text-center">Tipe</th>
                    <th class="py-3 px-6 text-center">Total Qty</th>
                    <th class="py-3 px-6 text-center">Total Harga Jual</th>
                    <th class="py-3 px-6 text-center">Total Harga Beli</th>
                    <th class="py-3 px-6 text-center">Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($data as $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="py-4 px-6">{{ $item->product_name }}</td>
                        <td class="py-4 px-6">{{ $item->category_name }}</td>
                        <td class="py-4 px-6">{{ $item->supplier_name }}</td>
                        <td class="py-4 px-6">{{ $item->sku }}</td>
                        <td class="py-4 px-6 text-center">{{ number_format($item->purchase_price, 2) }}</td>
                        <td class="py-4 px-6 text-center">{{ number_format($item->selling_price, 2) }}</td>
                        <td class="py-4 px-6 text-center font-semibold">{{ $item->current_stock }}</td>
                        <td class="py-4 px-6 text-center {{ $item->type == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($item->type) }}
                        </td>
                        <td class="py-4 px-6 text-center">{{ $item->total_quantity }}</td>
                        <td class="py-4 px-6 text-center font-semibold text-red-500">
                            {{ number_format($item->total_selling_price, 2) }}
                        </td>
                        <td class="py-4 px-6 text-center font-semibold text-green-500">
                            {{ number_format($item->total_purchasing_price, 2) }}
                        </td>
                        <td class="py-4 px-6 text-center">{{ $item->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
