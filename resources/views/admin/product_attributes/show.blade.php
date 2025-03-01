@extends('admin.navbar')

@section('title', 'Detail Attribut Produk')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center text-gray-800">Detail Atribut Produk</h1>

    <div class="flex justify-start mt-4">
        <a href="{{ route('admin.product_attributes.index') }}" 
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Kembali ke Daftar
        </a>
    </div>

    <div class="max-w-lg mx-auto mt-6 bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-700">{{ $productAttribute->name }}</h2>

        <div class="mt-4">
            <p><strong class="text-gray-600">ID:</strong> {{ $productAttribute->id }}</p>
            <p><strong class="text-gray-600">Produk:</strong> {{ $productAttribute->product->name }}</p>
            <p><strong class="text-gray-600">Nama:</strong> {{ $productAttribute->name }}</p>
            <p><strong class="text-gray-600">Nilai:</strong> {{ $productAttribute->value }}</p>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('admin.product_attributes.edit', $productAttribute->id) }}" 
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Edit
            </a>
            <form action="{{ route('admin.product_attributes.destroy', $productAttribute->id) }}" method="POST" 
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus atribut ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
