@extends('admin.navbar')

@section('title', 'Buat Produk Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">Create Product</h1>

    <!-- Tampilkan Error Jika Ada -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Category -->
        <label class="block font-medium">Category:</label>
        <select name="category_id" required class="w-full border p-2 rounded">
            <option value="" disabled selected>-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Supplier -->
        <label class="block font-medium mt-3">Supplier:</label>
        <select name="supplier_id" required class="w-full border p-2 rounded">
            <option value="" disabled selected>-- Select Supplier --</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
        @error('supplier_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Name -->
        <label class="block font-medium mt-3">Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required class="w-full border p-2 rounded">
        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- SKU -->
        <label class="block font-medium mt-3">SKU:</label>
        <input type="text" name="sku" value="{{ old('sku') }}" required class="w-full border p-2 rounded">
        @error('sku') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Description -->
        <label class="block font-medium mt-3">Description:</label>
        <textarea name="description" class="w-full border p-2 rounded">{{ old('description') }}</textarea>
        @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Purchase Price -->
        <label class="block font-medium mt-3">Purchase Price:</label>
        <input type="number" name="purchase_price" step="0.01" value="{{ old('purchase_price') }}" required class="w-full border p-2 rounded">
        @error('purchase_price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Selling Price -->
        <label class="block font-medium mt-3">Selling Price:</label>
        <input type="number" name="selling_price" step="0.01" value="{{ old('selling_price') }}" required class="w-full border p-2 rounded">
        @error('selling_price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Image Upload -->
        <label class="block font-medium mt-3">Product Image:</label>
        <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
        @error('image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <!-- Minimum Stock -->
        <label class="block font-medium mt-3">Minimum Stock:</label>
        <input type="number" name="minimum_stock" value="{{ old('minimum_stock') }}" required class="w-full border p-2 rounded">
        @error('minimum_stock') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

        <button type="submit" class="w-full bg-blue-600 text-white py-2 mt-4 rounded hover:bg-blue-700">
            Create Product
        </button>
    </form>
</div>
@endsection
