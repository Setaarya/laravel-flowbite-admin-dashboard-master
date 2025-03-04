@extends('admin.navbar')

@section('title', 'Stock Opname')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Stock Opname</h1>

    <div class="mb-4">
        <a href="{{ route('manager.export.stock.opname') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
            Export to Excel
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr class="text-gray-700">
                    <th class="px-4 py-3 text-left whitespace-nowrap w-1/5">Product</th>
                    <th class="px-4 py-3 text-left whitespace-nowrap w-1/5">Category</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-1/5">SKU</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-1/5">Current Stock</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-1/5">Minimum Stock</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-1/5">Manual Count</th>
                    <th class="px-4 py-3 text-center whitespace-nowrap w-1/5">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockData as $stock)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap">{{ $stock->name }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $stock->category }}</td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">{{ $stock->sku }}</td>
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
    document.querySelectorAll('.manual-count').forEach(input => {
        input.addEventListener('input', function () {
            let productId = this.dataset.productId;
            let manualCount = parseInt(this.value) || 0;
            let currentStock = parseInt(document.getElementById("current_stock_" + productId).innerText);

            let difference = manualCount - currentStock;
            let statusElement = document.getElementById("status_" + productId);

            statusElement.classList.remove('bg-gray-500', 'bg-green-500', 'bg-red-500');

            if (difference > 0) {
                statusElement.innerText = `Surplus (+${difference})`;
                statusElement.classList.add("bg-green-500");
            } else if (difference < 0) {
                statusElement.innerText = `Minus (${difference})`;
                statusElement.classList.add("bg-red-500");
            } else {
                statusElement.innerText = "Balanced (0)";
                statusElement.classList.add("bg-gray-500");
            }
        });
    });
});
</script>
@endsection
