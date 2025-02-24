<!DOCTYPE html>
<html>
<head>
    <title>Create Product Attribute</title>
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

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #3182ce;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body>
    <h1>Create Product Attribute</h1>
    <a href="{{ route('product_attributes.index') }}">Back to List</a>
    <form action="{{ route('product_attributes.store') }}" method="POST">
        @csrf
        @include('product_attributes.form')
        <button type="submit">Add Attribute</button>
    </form>
</body>
</html>
