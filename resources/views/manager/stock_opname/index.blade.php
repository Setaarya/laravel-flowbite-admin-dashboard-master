@extends('manager.navbar')

@section('title', 'Stock Opname')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Stock Opname</h1>

    <div class="mb-4 flex justify-between">
        <a href="{{ route('manager.export.stock.opname') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
            Export to Excel
        </a>
        <button id="saveStockOpname" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600">
            Save All
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr class="text-gray-700">
                    <th class="px-4 py-3 text-left">Product</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-center">SKU</th>
                    <th class="px-4 py-3 text-center">Current Stock</th>
                    <th class="px-4 py-3 text-center">Minimum Stock</th>
                    <th class="px-4 py-3 text-center">Manual Count</th>
                    <th class="px-4 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockData as $stock)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $stock->name }}</td>
                    <td class="px-4 py-3">{{ $stock->category }}</td>
                    <td class="px-4 py-3 text-center">{{ $stock->sku }}</td>
                    <td class="px-4 py-3 text-center font-bold text-blue-500" id="current_stock_{{ $stock->id }}">
                        {{ $stock->current_stock }}
                    </td>
                    <td class="px-4 py-3 text-center font-semibold text-yellow-500">
                        {{ $stock->minimum_stock }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <input type="number" class="w-20 p-2 border border-gray-300 rounded-md text-center manual-count"
                               data-product-id="{{ $stock->id }}" placeholder="Hitung ulang">
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span id="status_{{ $stock->id }}" class="px-3 py-1 text-white text-sm rounded-md bg-gray-500">
                            Balanced (0)
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let stockData = [];

    document.querySelectorAll('.manual-count').forEach(input => {
        input.addEventListener('input', function () {
            let productId = this.dataset.productId;
            let manualCount = parseInt(this.value) || 0;
            let currentStock = parseInt(document.getElementById("current_stock_" + productId).innerText);

            let difference = manualCount - currentStock;
            let statusElement = document.getElementById("status_" + productId);

            statusElement.classList.remove('bg-gray-500', 'bg-green-500', 'bg-red-500');

            let status;
            if (difference > 0) {
                status = `Surplus (+${difference})`;
                statusElement.classList.add("bg-green-500");
            } else if (difference < 0) {
                status = `Minus (${difference})`;
                statusElement.classList.add("bg-red-500");
            } else {
                status = "Balanced (0)";
                statusElement.classList.add("bg-gray-500");
            }
            statusElement.innerText = status;

            stockData = stockData.filter(item => item.product_id !== productId);
            stockData.push({ product_id: productId, manual_count: manualCount, status });
        });
    });

    document.getElementById('saveStockOpname').addEventListener('click', function () {
        fetch("{{ route('manager.stock.opname.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ stockData })
        }).then(response => response.json()).then(data => {
            alert(data.message);
        }).catch(error => {
            console.error("Error:", error);
        });
    });
});
</script>
@endsection
