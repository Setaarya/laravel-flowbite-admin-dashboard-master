@extends('manager.navbar')

@section('title', 'Buat Transaksi Stok Baru')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">Buat Transaksi Stok Baru</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('manager.stock_transactions.store') }}">
        @csrf

        <!-- Product Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Produk:</label>
            <select name="product_id" id="product_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="" disabled selected>-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-stock="{{ $product->current_stock }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Current Stock Display -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Stok Saat Ini:</label>
            <p id="current_stock" class="text-lg font-bold text-blue-500">-</p>
        </div>

        <!-- Type Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Jenis Transaksi:</label>
            <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
            </select>
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Jumlah:</label>
            <input type="number" name="quantity" id="quantity" class="w-full p-2 border border-gray-300 rounded" min="1" required>
            @error('quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Tanggal:</label>
            <input type="date" name="date" id="date" class="w-full p-2 border border-gray-300 rounded" value="{{ old('date', now()->format('Y-m-d')) }}" required>
            @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Notes -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Catatan:</label>
            <textarea name="notes" id="notes" class="w-full p-2 border border-gray-300 rounded">{{ old('notes') }}</textarea>
            @error('notes') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-2 bg-green-600 text-white rounded hover:bg-green-700">
            Buat Transaksi
        </button>
    </form>
</div>

<!-- JavaScript for Current Stock Update -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let productSelect = document.getElementById("product_id");
    let stockDisplay = document.getElementById("current_stock");

    productSelect.addEventListener("change", function () {
        let selectedOption = this.options[this.selectedIndex];
        let stock = selectedOption.getAttribute("data-stock") || "-";
        stockDisplay.textContent = stock;
    });
});
</script>
@endsection
