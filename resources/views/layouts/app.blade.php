<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')Stockify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #1a202c;
            color: white;
            height: 100vh;
            position: fixed;
        }

        .content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 1.5rem;
        }

        .header {
            background-color: #3182ce;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer {
            background-color: #2d3748;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        @include('layouts.navbar')
    </aside>

    <div class="content">
        <header class="header">
            <h1 class="text-2xl font-bold">@yield('page_title')</h1>
        </header>

        <main class="mt-4">
            @yield('content')
        </main>

        <footer class="footer">
            <p>&copy; 2025 Stockify. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
