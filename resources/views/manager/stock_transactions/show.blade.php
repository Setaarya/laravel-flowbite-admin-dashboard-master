@extends('manager.navbar')

@section('title', 'Detail Transaksi')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Stock Transaction Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #2b6cb0;
        }
        button {
            padding: 10px 20px;
            background-color: #e53e3e;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #c53030;
        }
        form {
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Stock Transaction Details</h1>
        <a href="{{ route('stock_transactions.index') }}">Back to Stock Transactions List</a>
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $stockTransaction->id }}</td>
            </tr>
            <tr>
                <th>Product</th>
                <td>{{ $stockTransaction->product->name }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $stockTransaction->user->name }}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ ucfirst($stockTransaction->type) }}</td>  {{-- Capitalize "in" -> "In", "out" -> "Out" --}}
            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $stockTransaction->quantity }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ \Carbon\Carbon::parse($stockTransaction->date)->format('d M Y') }}</td> {{-- Format tanggal --}}
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($stockTransaction->status) }}</td> {{-- Capitalize "pending", "completed", "canceled" --}}
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $stockTransaction->notes ?? 'No notes available' }}</td> {{-- Default jika notes kosong --}}
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $stockTransaction->created_at->format('d M Y H:i') }}</td> {{-- Format timestamp --}}
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $stockTransaction->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
        <a href="{{ route('stock_transactions.edit', $stockTransaction->id) }}">Edit Stock Transaction</a>
    </div>
</body>
</html>
@endsection