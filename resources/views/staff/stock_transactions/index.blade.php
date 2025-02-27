@extends('staff.navbar')

@section('title', 'Transaksi Stok')

@section('content')
    <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Stock Transactions List</h1>

    <table class="w-full border-collapse border border-gray-300 bg-white shadow-md">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Product</th>
                <th class="border border-gray-300 px-4 py-2">User</th>
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
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->user->name ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <span class="px-3 py-1 text-white text-sm rounded {{ $transaction->type == 'in' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </td>
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->quantity }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->status ?? '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $transaction->notes ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
