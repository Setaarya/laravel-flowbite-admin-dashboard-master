@extends('admin.navbar')

@section('title', 'Stock Opname')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Stock Opname (Admin)</h1>

    <!-- Tombol Export Excel dengan Styling Baru -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.stock_opname.export') }}" 
           class="flex items-center gap-2 bg-green-600 text-white px-5 py-2 rounded-lg shadow-md 
                  hover:bg-green-700 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> 
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <polyline points="7 10 12 15 17 10"/>
                <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Export Excel
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr class="text-gray-700">
                    <th class="px-4 py-3 text-left">Product</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-center">SKU</th>
                    <th class="px-4 py-3 text-center">Current Stock</th>
                    <th class="px-4 py-3 text-center">Manual Count</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Adjustment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockData as $stock)
                @php
                    // Tentukan warna berdasarkan status
                    $statusColor = match (true) {
                        str_contains($stock->status, 'Balanced') => 'bg-gray-500',
                        str_contains($stock->status, 'Surplus') => 'bg-green-500',
                        str_contains($stock->status, 'Minus') => 'bg-red-500',
                        default => 'bg-gray-500',
                    };
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $stock->product->name }}</td>
                    <td class="px-4 py-3">{{ $stock->category->name }}</td>
                    <td class="px-4 py-3 text-center">{{ $stock->product->sku }}</td>
                    <td class="px-4 py-3 text-center font-bold text-blue-500" id="current_stock_{{ $stock->id }}">
                        {{ $stock->product->current_stock }}
                    </td>
                    <td class="px-4 py-3 text-center font-semibold text-yellow-500">
                        {{ $stock->manual_count }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span id="status_{{ $stock->id }}" class="px-3 py-1 text-white text-sm rounded-md {{ $statusColor }}">
                            {{ $stock->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <input type="number" class="w-20 p-2 border border-gray-300 rounded-md text-center adjustment-value" 
                               data-stock-id="{{ $stock->id }}" placeholder="Adjust">
                        <button class="bg-green-500 text-white px-3 py-1 rounded-md save-adjustment"
                                data-stock-id="{{ $stock->id }}">
                            Save
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.save-adjustment').forEach(button => {
        button.addEventListener('click', function () {
            let stockId = this.dataset.stockId;
            let adjustmentValue = document.querySelector(`.adjustment-value[data-stock-id="${stockId}"]`).value;

            fetch(`/admin/stock-opname/adjust/${stockId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ adjustment_value: adjustmentValue })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                
                document.getElementById(`current_stock_${stockId}`).innerText = data.new_stock;
                let statusElement = document.getElementById(`status_${stockId}`);
                statusElement.innerText = data.status;

                // Update warna status berdasarkan kondisi baru
                if (data.status.includes("Balanced")) {
                    statusElement.className = "px-3 py-1 text-white text-sm rounded-md bg-gray-500";
                } else if (data.status.includes("Surplus")) {
                    statusElement.className = "px-3 py-1 text-white text-sm rounded-md bg-green-500";
                } else if (data.status.includes("Minus")) {
                    statusElement.className = "px-3 py-1 text-white text-sm rounded-md bg-red-500";
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endsection
