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
    <a href="{{ route('home') }}">Home</a>
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
            <td>{{ $transaction->product->name }}</td>
            <td>{{ $transaction->user->name }}</td>
            <td>{{ $transaction->type }}</td>
            <td>{{ $transaction->quantity }}</td>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->status }}</td>
            <td>{{ $transaction->notes }}</td>
            <td>
                <a href="{{ route('stock_transactions.show', $transaction->id) }}">Show</a>
                <a href="{{ route('stock_transactions.edit', $transaction->id) }}">Edit</a>
                <form action="{{ route('stock_transactions.destroy', $transaction->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
