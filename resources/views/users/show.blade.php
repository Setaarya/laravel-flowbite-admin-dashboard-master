<!DOCTYPE html>
<html>
<head>
    <title>Show User</title>
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
        div {
            margin-bottom: 10px;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        span {
            display: block;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Show User</h1>
        <div>
            <label>ID:</label>
            <span>{{ $user->id }}</span>
        </div>
        <div>
            <label>Name:</label>
            <span>{{ $user->name }}</span>
        </div>
        <div>
            <label>Email:</label>
            <span>{{ $user->email }}</span>
        </div>
        <div>
            <label>Role:</label>
            <span>{{ $user->role }}</span>
        </div>
    </div>
</body>
</html>
