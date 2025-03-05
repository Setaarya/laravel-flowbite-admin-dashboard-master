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
                    <option value="{{ $product->id }}" data-stock="{{ $product->current_stock }}"
                        {{ old('product_id', $stockTransaction->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Current Stock -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Stok Saat Ini:</label>
            <input type="text" id="current_stock" class="w-full p-2 border border-gray-300 rounded bg-gray-100" readonly>
        </div>

        <!-- Type Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Jenis Transaksi:</label>
            <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="masuk" {{ old('type', $stockTransaction->type) == 'masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="keluar" {{ old('type', $stockTransaction->type) == 'keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Jumlah:</label>
            <input type="number" name="quantity" id="quantity" class="w-full p-2 border border-gray-300 rounded"
                value="{{ old('quantity', $stockTransaction->quantity) }}" min="1" required>
            @error('quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update Transaksi
        </button>
    </form>
</div>

<script>
    function updateStock() {
        let selectedOption = document.getElementById('product_id').options[document.getElementById('product_id').selectedIndex];
        let stock = selectedOption.getAttribute('data-stock') || '0';
        document.getElementById('current_stock').value = stock;
    }

    document.getElementById('product_id').addEventListener('change', updateStock);

    // Set initial value on page load
    window.onload = updateStock;
</script>
@endsection
