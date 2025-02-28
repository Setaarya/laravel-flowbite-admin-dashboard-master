@extends('manager.navbar')

@section('title', 'Edit Transaksi Stok')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">Edit Transaksi Stok</h1>

    <form method="POST" action="{{ route('manager.stock_transactions.update', $stockTransaction->id) }}">
        @csrf
        @method('PUT')

        <!-- Product Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Produk:</label>
            <select name="product_id" id="product_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="" disabled>-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $stockTransaction->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Type Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Jenis Transaksi:</label>
            <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="in" {{ old('type', $stockTransaction->type) == 'in' ? 'selected' : '' }}>Masuk</option>
                <option value="out" {{ old('type', $stockTransaction->type) == 'out' ? 'selected' : '' }}>Keluar</option>
            </select>
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Jumlah:</label>
            <input type="number" name="quantity" id="quantity" class="w-full p-2 border border-gray-300 rounded" value="{{ old('quantity', $stockTransaction->quantity) }}" min="1" required>
            @error('quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Tanggal:</label>
            <input type="date" name="date" id="date" class="w-full p-2 border border-gray-300 rounded" value="{{ old('date', $stockTransaction->date) }}" required>
            @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Notes -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Catatan:</label>
            <textarea name="notes" id="notes" class="w-full p-2 border border-gray-300 rounded">{{ old('notes', $stockTransaction->notes) }}</textarea>
            @error('notes') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update Transaksi
        </button>
    </form>
</div>
@endsection
