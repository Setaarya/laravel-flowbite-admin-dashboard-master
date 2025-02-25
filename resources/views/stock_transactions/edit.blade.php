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
            color: red;
            font-size: 12px;
            margin-top: -5px;
            margin-bottom: 10px;
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
                <option value="" disabled>-- Select Product --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $stockTransaction->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <div class="error">{{ $message }}</div> @enderror

            <label>User:</label>
            <select name="user_id" required>
                <option value="" disabled>-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $stockTransaction->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id') <div class="error">{{ $message }}</div> @enderror

            <label>Type:</label>
            <select name="type" required>
                <option value="in" {{ old('type', $stockTransaction->type) == 'in' ? 'selected' : '' }}>Stock In</option>
                <option value="out" {{ old('type', $stockTransaction->type) == 'out' ? 'selected' : '' }}>Stock Out</option>
            </select>
            @error('type') <div class="error">{{ $message }}</div> @enderror

            <label>Quantity:</label>
            <input type="number" name="quantity" value="{{ old('quantity', $stockTransaction->quantity) }}" required>
            @error('quantity') <div class="error">{{ $message }}</div> @enderror

            <label>Date:</label>
            <input type="date" name="date" value="{{ old('date', $stockTransaction->date) }}" required>
            @error('date') <div class="error">{{ $message }}</div> @enderror

            <label>Status:</label>
            <select name="status" required>
                <option value="pending" {{ old('status', $stockTransaction->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status', $stockTransaction->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ old('status', $stockTransaction->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
            @error('status') <div class="error">{{ $message }}</div> @enderror

            <label>Notes:</label>
            <textarea name="notes">{{ old('notes', $stockTransaction->notes) }}</textarea>
            @error('notes') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
