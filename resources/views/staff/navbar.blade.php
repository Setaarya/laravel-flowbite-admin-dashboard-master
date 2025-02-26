<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #1f2937;
            color: white;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-top: 1rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            padding-bottom: 1rem;
            border-bottom: 1px solid #374151;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar li {
            margin: 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            font-size: 1rem;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .sidebar a:hover {
            background-color: #374151;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: #4a5568;
            font-weight: bold;
        }

        /* Styling Logout */
        .logout-container {
            padding: 10px;
            background-color: #dc2626;
            border-radius: 5px;
            margin: 15px;
        }

        .logout {
            width: 100%;
            padding: 12px 20px;
            background-color: #dc2626;
            color: white;
            text-align: left;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: start;
            border-radius: 5px;
            font-weight: bold;
        }

        .logout i {
            margin-right: 10px;
        }

        /* Content */
        .content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div>
            <div class="sidebar-header">Stockify</div>
            <ul>
                <li>
                    <a href="{{ route('stock_transactions.staff_index') }}" class="{{ request()->routeIs('stock_transactions.staff_index') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt"></i> Transaksi
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tombol Logout -->
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <footer class="bg-gray-800 text-white p-4 mt-8 text-center">
        <p>&copy; 2025 Stockify. All rights reserved.</p>
    </footer>

    <!-- Flowbite JS -->
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.js"></script>
</body>
</html>
