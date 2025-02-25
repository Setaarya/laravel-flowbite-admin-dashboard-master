<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
</head>
<body>
    <header class="bg-blue-600 text-white p-4">
        <div class="container flex justify-between items-center mx-auto">
            <h1 class="text-2xl font-bold">Dashboard</h1>
        </div>
    </header>

    <div class="container mx-auto p-6">
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Welcome, Staff!</h2>
            <p class="mb-4">This is your dashboard where you can view and manage tasks.</p>

            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <!-- Barang Masuk -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Masuk yang Perlu Diperiksa</h3>
                    <ul class="space-y-2">
                        @foreach ($tasks['barang_masuk'] as $task)
                            <li class="p-4 bg-gray-100 rounded-lg shadow-sm">{{ $task->product->name }} - {{ $task->quantity }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Barang Keluar -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Keluar yang Perlu Disiapkan</h3>
                    <ul class="space-y-2">
                        @foreach ($tasks['barang_keluar'] as $task)
                            <li class="p-4 bg-gray-100 rounded-lg shadow-sm">{{ $task->product->name }} - {{ $task->quantity }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Konfirmasi Penerimaan -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Konfirmasi Penerimaan Barang</h3>
                    <ul class="space-y-2">
                        @foreach ($tasks['konfirmasi_penerimaan'] as $task)
                            <li class="p-4 bg-gray-100 rounded-lg shadow-sm">{{ $task->product->name }} - {{ $task->quantity }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Konfirmasi Pengeluaran -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Konfirmasi Pengeluaran Barang</h3>
                    <ul class="space-y-2">
                        @foreach ($tasks['konfirmasi_pengeluaran'] as $task)
                            <li class="p-4 bg-gray-100 rounded-lg shadow-sm">{{ $task->product->name }} - {{ $task->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Stockify. All rights reserved.</p>
        </div>
    </footer>

    <!-- Flowbite JS -->
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.js"></script>
</body>
</html>
