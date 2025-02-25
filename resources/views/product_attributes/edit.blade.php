<!DOCTYPE html>
<html>
<head>
    <title>Edit Product Attribute</title>
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

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
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
    <h1>Edit Product Attribute</h1>
    
    <form action="{{ route('product_attributes.update', $productAttribute->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Product:</label>
        <select name="product_id" required>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" 
                    {{ $product->id == $productAttribute->product_id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>

        <label>Attribute Name:</label>
        <input type="text" name="name" value="{{ $productAttribute->name }}" required>

        <label>Value:</label>
        <input type="text" name="value" value="{{ $productAttribute->value }}" required>

        <button type="submit">Update Attribute</button>
    </form>
</body>
</html>
