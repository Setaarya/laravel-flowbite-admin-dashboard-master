
@extends('admin.navbar')

@section('title', 'Transaksi Stok')

@section('content')
    <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Stock Transactions List</h1>

    <table class="w-full border-collapse border border-gray-300 bg-white shadow-md">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Product</th>
                <th class="border border-gray-300 px-4 py-2">Type</th>
                <th class="border border-gray-300 px-4 py-2">Quantity</th>
                <th class="border border-gray-300 px-4 py-2">Date</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr class="border border-gray-300 text-gray-700">
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->product->name ?? 'N/A' }}</td>
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
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->quantity }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
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
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->notes ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
