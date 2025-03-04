@extends('admin.navbar')

@section('title', 'Detail Produk')

@section('content')
<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Detail Produk</h1>

        <!-- Gambar Produk -->
        <div class="flex justify-center mb-4">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="max-w-xs rounded-lg shadow-md">
            @else
                <p class="text-gray-500">No Image Available</p>
            @endif
        </div>

        <!-- Informasi Produk -->
        <table class="w-full border-collapse border border-gray-300">
            <tbody>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">ID</th>
                    <td class="p-2">{{ $product->id }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Kategori</th>
                    <td class="p-2">{{ $product->category->name }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Supplier</th>
                    <td class="p-2">{{ $product->supplier->name }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Nama</th>
                    <td class="p-2">{{ $product->name }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">SKU</th>
                    <td class="p-2">{{ $product->sku }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Deskripsi</th>
                    <td class="p-2">{{ $product->description }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Harga Beli</th>
                    <td class="p-2">Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Harga Jual</th>
                    <td class="p-2">Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Stok Saat Ini</th>
                    <td class="p-2">{{ $product->current_stock }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Stok Minimum</th>
                    <td class="p-2">{{ $product->minimum_stock }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left bg-gray-200">Dibuat Pada</th>
                    <td class="p-2">{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <th class="p-2 text-left bg-gray-200">Diperbarui Pada</th>
                    <td class="p-2">{{ $product->updated_at }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Menampilkan Product Attributes -->
        @if ($product->attributes->count() > 0)
            <h2 class="text-xl font-semibold mt-6">Atribut Produk</h2>
            <table class="w-full mt-2 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 text-left">Atribut</th>
                        <th class="p-2 text-left">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->attributes as $attribute)
                        <tr class="border-b">
                            <td class="p-2">{{ $attribute->name }}</td>
                            <td class="p-2">{{ $attribute->value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 mt-2">Tidak ada atribut yang tersedia</p>
        @endif

        <!-- Tombol Aksi -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                Kembali ke Daftar Produk
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-yellow-600">
                Edit Produk
            </a>
        </div>

        <!-- Form Hapus Produk -->
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-700">
                Hapus Produk
            </button>
        </form>
    </div>
</div>
@endsection
