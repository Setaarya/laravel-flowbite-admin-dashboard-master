@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('admin.navbar')

@section('title', 'Edit Detail Produk')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">Edit Produk</h1>

    <!-- Tampilkan Error Jika Ada -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Kategori:</label>
                <select name="category_id" class="w-full p-2 border rounded" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold">Supplier:</label>
                <select name="supplier_id" class="w-full p-2 border rounded" required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold">Nama Produk:</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block font-semibold">SKU:</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block font-semibold">Harga Beli:</label>
                <input type="number" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" step="0.01" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block font-semibold">Harga Jual:</label>
                <input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" step="0.01" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block font-semibold">Stok Saat Ini:</label>
                <span class="w-full p-2 border rounded block">{{ $product->current_stock }}</span>
            </div>
        
            <div>
                <label class="block font-semibold">Stok Minimum:</label>
                <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div class="mt-4">
            <label class="block font-semibold">Deskripsi:</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="3" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Preview Image -->
        @if ($product->image)
            <div class="mt-4 text-center">
                <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="w-320 h-64 max-w-md object-cover mx-auto rounded-lg shadow-lg border border-gray-300">
            </div>
        @endif

        <div class="mt-4">
            <label class="block font-semibold">Ganti Gambar:</label>
            <input type="file" name="image" accept="image/*" class="w-full p-2 border rounded">
        </div>


        <button type="submit" class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Update Produk
        </button>
    </form>
</div>
@endsection


