<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
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
            width: 300px;
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
        <h1>Product Details</h1>
        <a href="{{ route('products.index') }}">Back to Product List</a>
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <th>Supplier</th>
                <td>{{ $product->supplier->name }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>SKU</th>
                <td>{{ $product->sku }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <th>Purchase Price</th>
                <td>{{ $product->purchase_price }}</td>
            </tr>
            <tr>
                <th>Selling Price</th>
                <td>{{ $product->selling_price }}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>{{ $product->image }}</td>
            </tr>
            <tr>
                <th>Minimum Stock</th>
                <td>{{ $product->minimum_stock }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $product->created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $product->updated_at }}</td>
            </tr>
        </table>
        <a href="{{ route('products.edit', $product->id) }}">Edit Product</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Product</button>
        </form>
    </div>
</body>
</html>
