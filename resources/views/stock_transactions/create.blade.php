<!DOCTYPE html>
<html>
<head>
    <title>Create Stock Transaction</title>
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
        input[type="date"],
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
            background-color: #28a745;
            border: none;
            border-radius: 3px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Stock Transaction</h1>
        <form action="{{ route('stock_transactions.store') }}" method="POST">
            @csrf
            <label>Product:</label>
            <select name="product_id" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <label>User:</label>
            <select name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <label>Type:</label>
            <input type="text" name="type" required>
            <label>Quantity:</label>
            <input type="number" name="quantity" required>
            <label>Date:</label>
            <input type="date" name="date" required>
            <label>Status:</label>
            <input type="text" name="status" required>
            <label>Notes:</label>
            <textarea name="notes"></textarea>
            <button type="submit">Create</button>
        </form>
    </div>
</body>
</html>
