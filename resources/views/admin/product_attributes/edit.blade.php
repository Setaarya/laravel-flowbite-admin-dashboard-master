@extends('admin.navbar')

@section('title', 'Edit Atribut Produk')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center text-gray-800">Edit Atribut Produk</h1>

    <div class="flex justify-start mt-4">
        <a href="{{ route('admin.product_attributes.index') }}" 
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Kembali ke Daftar
        </a>
    </div>

    <div class="max-w-lg mx-auto mt-6 bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <form action="{{ route('admin.product_attributes.update', $productAttribute->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Produk:</label>
                <select name="product_id" class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" 
                            {{ $product->id == $productAttribute->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Atribut:</label>
                <input type="text" name="name" value="{{ $productAttribute->name }}" 
                    class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nilai:</label>
                <input type="text" name="value" value="{{ $productAttribute->value }}" 
                    class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                Perbarui Atribut
            </button>
        </form>
    </div>
</div>
@endsection
