<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
        input[type="email"],
        input[type="password"],
        select {
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
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="password" value="{{ $user->password }}" required>
            </div>
            <div>
                <label>Role:</label>
                <select name="role" required>
                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Staff Gudang" {{ $user->role == 'Staff Gudang' ? 'selected' : '' }}>Staff Gudang</option>
                    <option value="Manajer Gudang" {{ $user->role == 'Manajer Gudang' ? 'selected' : '' }}>Manajer Gudang</option>
                </select>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
