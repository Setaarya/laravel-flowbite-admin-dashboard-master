@extends('staff.navbar')

@section('title', 'Stock Transactions')

@section('content')
<h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Stock Transactions List</h1>

<table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 p-2">ID</th>
            <th class="border border-gray-300 p-2">Product</th>
            <th class="border border-gray-300 p-2">User</th>
            <th class="border border-gray-300 p-2">Type</th>
            <th class="border border-gray-300 p-2">Quantity</th>
            <th class="border border-gray-300 p-2">Date</th>
            <th class="border border-gray-300 p-2">Status</th>
            <th class="border border-gray-300 p-2">Notes</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
            <td class="border border-gray-300 p-2">{{ $transaction->id }}</td>
            <td class="border border-gray-300 p-2">{{ $transaction->product->name ?? 'N/A' }}</td>
            <td class="border border-gray-300 p-2">{{ $transaction->user->name ?? 'N/A' }}</td>
            <td class="border border-gray-300 p-2">
                <span class="{{ $transaction->type == 'in' ? 'status-in' : 'status-out' }}">
                    {{ ucfirst($transaction->type) }}
                </span>
            </td>
            <td class="border border-gray-300 p-2">{{ $transaction->quantity }}</td>
            <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
            <td class="border border-gray-300 p-2">{{ $transaction->status ?? '-' }}</td>
            <td class="border border-gray-300 p-2">{{ $transaction->notes ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
