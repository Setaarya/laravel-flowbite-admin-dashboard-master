<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
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

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2d3748;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3182ce;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body>
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label>Category:</label>
        <select name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <label>Supplier:</label>
        <select name="supplier_id" required>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>SKU:</label>
        <input type="text" name="sku" required>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <label>Purchase Price:</label>
        <input type="number" name="purchase_price" step="0.01" required>
        <label>Selling Price:</label>
        <input type="number" name="selling_price" step="0.01" required>
        <label>Image:</label>
        <input type="text" name="image">
        <label>Minimum Stock:</label>
        <input type="number" name="minimum_stock" required>
        <button type="submit">Create</button>
    </form>
</body>
</html>
