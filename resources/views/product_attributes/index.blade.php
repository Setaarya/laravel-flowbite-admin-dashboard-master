<!DOCTYPE html>
<html>
<head>
    <title>Product Attributes</title>
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
    <h1>Product Attributes List</h1>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('product_attributes.create') }}">Create New Product Attribute</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Name</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
        @foreach ($attributes as $attribute)
        <tr>
            <td>{{ $attribute->id }}</td>
            <td>{{ $attribute->product->name }}</td>
            <td>{{ $attribute->name }}</td>
            <td>{{ $attribute->value }}</td>
            <td>
                <a href="{{ route('product_attributes.show', $attribute->id) }}">Show</a>
                <a href="{{ route('product_attributes.edit', $attribute->id) }}">Edit</a>
                <form action="{{ route('product_attributes.destroy', $attribute->id) }}" method="POST" style="display:inline-block;">
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
