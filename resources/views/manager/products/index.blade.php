@extends('manager.navbar')

@section('title', 'Daftar Produk')

@section('content')
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

        .image-preview img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Products List</h1>

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
            <td>{{ Str::limit($product->description, 50) }}</td> <!-- Batasi panjang deskripsi -->
            <td>Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td> <!-- Format harga -->
            <td>Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>

            <td class="image-preview">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $product->current_stock }}</td>
            <td>{{ $product->minimum_stock }}</td>
            <td>
                <a href="{{ route('manager.products.show', $product->id) }}">Show</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
@endsection