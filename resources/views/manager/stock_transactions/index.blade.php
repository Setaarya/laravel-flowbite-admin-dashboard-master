@extends('manager.navbar')

@section('title', 'Daftar Transaksi')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Stock Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2d3748;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #2b6cb0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #cbd5e0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #e2e8f0;
            color: #2d3748;
        }

        tr:nth-child(even) {
            background-color: #f7fafc;
        }

        .status-in {
            background-color: #48bb78;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .status-out {
            background-color: #e53e3e;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
        }

        button {
            padding: 6px 12px;
            background-color: #e53e3e;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c53030;
        }
    </style>
</head>
<body>
    <h1>Stock Transactions List</h1>
    <a href="{{ route('stock_transactions.create') }}">Create New Stock Transaction</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>User</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->product->name ?? 'N/A' }}</td>
            <td>{{ $transaction->user->name ?? 'N/A' }}</td>
            <td>
                <span class="{{ $transaction->type == 'in' ? 'status-in' : 'status-out' }}">
                    {{ ucfirst($transaction->type) }}
                </span>
            </td>
            <td>{{ $transaction->quantity }}</td>
            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
            <td>{{ $transaction->status ?? '-' }}</td>
            <td>{{ $transaction->notes ?? '-' }}</td>
            <td>
                <a href="{{ route('stock_transactions.show', $transaction->id) }}">Show</a>
                <a href="{{ route('stock_transactions.edit', $transaction->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
@endsection