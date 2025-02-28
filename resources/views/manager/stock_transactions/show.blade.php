@extends('manager.navbar')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Stock Transaction Details</h1>

    <!-- Card Detail Transaksi -->
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-2xl mx-auto">
        <table class="w-full border-collapse">
            <tbody>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">ID</th>
                    <td class="px-4 py-2">{{ $stockTransaction->id }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Product</th>
                    <td class="px-4 py-2">{{ $stockTransaction->product->name }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Type</th>
                    <td class="px-4 py-2">{{ ucfirst($stockTransaction->type) }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Quantity</th>
                    <td class="px-4 py-2">{{ $stockTransaction->quantity }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Date</th>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($stockTransaction->date)->format('d M Y') }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Status</th>
                    <td class="px-4 py-2">
                        @php
                            $statusColor = match (strtolower($stockTransaction->status)) {
                                'pending' => 'bg-yellow-500',
                                'received' => 'bg-green-500',
                                'dispatched' => 'bg-blue-500',
                                default => 'bg-gray-500',
                            };
                        @endphp
                        <span class="px-3 py-1 text-white text-sm rounded {{ $statusColor }}">
                            {{ strtoupper($stockTransaction->status) }}
                        </span>
                    </td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Notes</th>
                    <td class="px-4 py-2">{{ $stockTransaction->notes ?? 'No notes available' }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-2 bg-gray-100">Created At</th>
                    <td class="px-4 py-2">{{ $stockTransaction->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 bg-gray-100">Updated At</th>
                    <td class="px-4 py-2">{{ $stockTransaction->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Edit -->
        <div class="mt-4">
            <a href="{{ route('manager.stock_transactions.edit', $stockTransaction->id) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-md">
                Edit Stock Transaction
            </a>
        </div>
    </div>
</div>
@endsection
