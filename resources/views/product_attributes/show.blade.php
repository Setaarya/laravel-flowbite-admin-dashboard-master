<!DOCTYPE html>
<html>
<head>
    <title>Product Attribute Details</title>
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

        .card {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            background-color: white;
            padding: 20px;
        }

        .card-header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-body p {
            margin: 10px 0;
        }

        .card-footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Product Attribute Details</h1>
    <a href="{{ route('product_attributes.index') }}">Back to List</a>
    <div class="card">
        <div class="card-header">{{ $productAttribute->name }}</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $productAttribute->id }}</p>
            <p><strong>Product:</strong> {{ $productAttribute->product->name }}</p>
            <p><strong>Name:</strong> {{ $productAttribute->name }}</p>
            <p><strong>Value:</strong> {{ $productAttribute->value }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('product_attributes.edit', $productAttribute->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('product_attributes.destroy', $productAttribute->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</body>
</html>
