<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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
    <h1>Products List</h1>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('products.create') }}">Create New Product</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Description</th>
            <th>Purchase Price</th>
            <th>Selling Price</th>
            <th>Image</th>
            <th>Minimum Stock</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->supplier->name }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->purchase_price }}</td>
            <td>{{ $product->selling_price }}</td>
            <td>{{ $product->image }}</td>
            <td>{{ $product->minimum_stock }}</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}">Show</a>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
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
