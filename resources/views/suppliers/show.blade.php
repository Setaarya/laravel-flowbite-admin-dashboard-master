<!DOCTYPE html>
<html>
<head>
    <title>Supplier Details</title>
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
    <h1>Supplier Details</h1>
    <a href="{{ route('suppliers.index') }}">Back to Supplier List</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <td>{{ $supplier->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $supplier->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $supplier->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $supplier->phone }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $supplier->address }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $supplier->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $supplier->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('suppliers.edit', $supplier->id) }}">Edit Supplier</a>
    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Supplier</button>
    </form>
</body>
</html>
