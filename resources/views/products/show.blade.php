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
        .image-preview {
            text-align: center;
            margin-bottom: 15px;
        }
        .image-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        a, button {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        a {
            background-color: #3182ce;
            color: white;
        }
        a:hover {
            background-color: #2b6cb0;
        }
        button {
            background-color: #e53e3e;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #c53030;
        }
        form {
            display: inline-block;
            width: 100%;
        }
        .attributes-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Details</h1>

        <div class="image-preview">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
            @else
                <p>No Image Available</p>
            @endif
        </div>

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
                <td>Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Selling Price</th>
                <td>Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>
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

        <!-- Menampilkan Product Attributes -->
        @if ($product->attributes->count() > 0)
            <h2>Attributes</h2>
            <table class="attributes-table">
                <tr>
                    <th>Attribute</th>
                    <th>Value</th>
                </tr>
                @foreach ($product->attributes as $attribute)
                <tr>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->value }}</td>
                </tr>
                @endforeach
            </table>
        @else
            <p>No Attributes Available</p>
        @endif

        <a href="{{ route('products.index') }}">Back to Product List</a>
        <a href="{{ route('products.edit', $product->id) }}">Edit Product</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Product</button>
        </form>
    </div>
</body>
</html>
