<!DOCTYPE html>
<html>
<head>
    <title>Category Details</title>
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
        <h1>Category Details</h1>
        <a href="{{ route('categories.index') }}">Back to Category List</a>
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $category->description }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $category->created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $category->updated_at }}</td>
            </tr>
        </table>
        <a href="{{ route('categories.edit', $category->id) }}">Edit Category</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Category</button>
        </form>
    </div>
</body>
</html>
