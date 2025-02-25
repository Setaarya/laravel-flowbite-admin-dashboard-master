<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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
        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 3px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            background-color: #fde8e8;
            color: #e53e3e;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 16px;
            font-size: 14px;
        }
        .image-preview {
            text-align: center;
            margin-bottom: 10px;
        }
        .image-preview img {
            max-width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>

        <!-- Tampilkan Error Jika Ada -->
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Category:</label>
            <select name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label>Supplier:</label>
            <select name="supplier_id" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>

            <label>Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label>SKU:</label>
            <input type="text" name="sku" value="{{ $product->sku }}" required>

            <label>Description:</label>
            <textarea name="description" required>{{ $product->description }}</textarea>

            <label>Purchase Price:</label>
            <input type="number" name="purchase_price" value="{{ $product->purchase_price }}" step="0.01" required>

            <label>Selling Price:</label>
            <input type="number" name="selling_price" value="{{ $product->selling_price }}" step="0.01" required>

            <!-- Preview Image -->
            @if ($product->image)
                <div class="image-preview">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                </div>
            @endif

            <label>Change Image:</label>
            <input type="file" name="image" accept="image/*">

            <label>Minimum Stock:</label>
            <input type="number" name="minimum_stock" value="{{ $product->minimum_stock }}" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
