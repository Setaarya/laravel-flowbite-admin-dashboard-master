<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css">
</head>
<body>
    <header class="bg-blue-600 text-white p-4">
        <div class="container flex justify-between items-center mx-auto">
            <h1 class="text-2xl font-bold">Dashboard</h1>
        </div>
    </header>

    <div class="container mx-auto p-6">
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Dashboard Overview</h2>
            <p class="mb-4">Here is a summary of important information.</p>

            <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Products -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Total Products</h3>
                    <p class="text-2xl font-bold">{{ $data['total_products'] }}</p>
                </div>

                <!-- Incoming Transactions -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Incoming Transactions</h3>
                    <p class="text-2xl font-bold">{{ $data['incoming_transactions'] }}</p>
                </div>

                <!-- Outgoing Transactions -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Outgoing Transactions</h3>
                    <p class="text-2xl font-bold">{{ $data['outgoing_transactions'] }}</p>
                </div>

                <!-- Stock Levels Chart Placeholder -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Stock Levels</h3>
                    <canvas id="stockLevelsChart"></canvas>
                </div>

                <!-- Latest User Activities -->
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs">
                    <h3 class="mb-4 text-lg font-semibold text-gray-600">Latest User Activities</h3>
                    <ul class="space-y-2">
                        @foreach ($data['latest_user_activities'] as $activity)
                            <li class="p-4 bg-gray-100 rounded-lg shadow-sm">{{ $activity->name }}: {{ $activity->created_at }}</li>
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

    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('stockLevelsChart').getContext('2d');
        const stockLevelsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($data['stock_levels']->pluck('name')) !!},
                datasets: [{
                    label: 'Stock Levels',
                    data: {!! json_encode($data['stock_levels']->pluck('stock')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
