@extends('manager.navbar')

@section('title', 'Buat Transaksi Baru')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">Create Stock Transaction</h1>

    <form action="{{ route('manager.stock_transactions.store') }}" method="POST">
        @csrf

        <!-- Product Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Product:</label>
            <select name="product_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="" disabled selected>-- Select Product --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Type Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Type:</label>
            <select name="type" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Stock In</option>
                <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Stock Out</option>
            </select>
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Quantity:</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full p-2 border border-gray-300 rounded" required>
            @error('quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Date:</label>
            <input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" class="w-full p-2 border border-gray-300 rounded" required>
            @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Status (Hidden Field: Always Pending) -->
        <input type="hidden" name="status" value="pending">

        <!-- Notes -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Notes:</label>
            <textarea name="notes" class="w-full p-2 border border-gray-300 rounded">{{ old('notes') }}</textarea>
            @error('notes') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-2 bg-green-600 text-white rounded hover:bg-green-700">
            Create
        </button>
    </form>
</div>
@endsection
