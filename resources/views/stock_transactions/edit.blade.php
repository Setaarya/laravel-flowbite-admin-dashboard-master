<!DOCTYPE html>
<html>
<head>
    <title>Edit Stock Transaction</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Stock Transaction</h1>
        <form action="{{ route('stock_transactions.update', $stockTransaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Product:</label>
            <select name="product_id" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $stockTransaction->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
            <label>User:</label>
            <select name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $stockTransaction->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            <label>Type:</label>
            <input type="text" name="type" value="{{ $stockTransaction->type }}" required>
            <label>Quantity:</label>
            <input type="number" name="quantity" value="{{ $stockTransaction->quantity }}" required>
            <label>Date:</label>
            <input type="date" name="date" value="{{ $stockTransaction->date }}" required>
            <label>Status:</label>
            <input type="text" name="status" value="{{ $stockTransaction->status }}" required>
            <label>Notes:</label>
            <textarea name="notes">{{ $stockTransaction->notes }}</textarea>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
