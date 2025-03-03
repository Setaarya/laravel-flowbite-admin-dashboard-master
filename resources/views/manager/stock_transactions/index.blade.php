@extends('manager.navbar')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Stock Transactions List</h1>

    <div class="w-full flex justify-start mb-4">
        <a href="{{ route('manager.stock_transactions.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-md">
            Create New Stock Transaction
        </a>
        <a href="{{ route('manager.stock_transactions.stock_opname') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-md">
            Create Stock Opname
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Product</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Quantity</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Notes</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $transaction->id }}</td>
                    <td class="px-4 py-3">{{ $transaction->product->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3">
                        @php
                            $typeColor = match($transaction->type) {
                                'masuk' => 'bg-green-500',  // Warna hijau untuk transaksi masuk
                                'keluar' => 'bg-red-500',   // Warna merah untuk transaksi keluar
                                default => 'bg-gray-500' // Warna abu-abu jika ada kesalahan data
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-md text-white {{ $typeColor }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ $transaction->quantity }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @php
                            $statusColor = match (strtolower($transaction->status)) {
                                'pending' => 'bg-yellow-500',
                                'received' => 'bg-green-500',
                                'dispatched' => 'bg-blue-500',
                                default => 'bg-gray-500',
                            };
                        @endphp
                        <span class="px-3 py-1 text-white text-sm rounded {{ $statusColor }}">
                            {{ strtoupper($transaction->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ $transaction->notes ?? '-' }}</td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="{{ route('manager.stock_transactions.show', $transaction->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md shadow-md">
                            Show
                        </a>
                        <a href="{{ route('manager.stock_transactions.edit', $transaction->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md shadow-md">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
