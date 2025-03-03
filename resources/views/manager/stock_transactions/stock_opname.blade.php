@extends('manager.navbar')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Stock Opname</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-3">Product</th>
                    <th class="border p-3">Stock in System</th>
                    <th class="border p-3">Actual Stock</th>
                    <th class="border p-3">Difference</th>
                    <th class="border p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockData as $stock)
                    @php
                        $calculatedStock = $stock->total_in - $stock->total_out;
                    @endphp
                    <tr>
                        <td class="border p-3">{{ $stock->product->name }}</td>
                        <td class="border p-3 text-center">{{ $calculatedStock }}</td>
                        <td class="border p-3">
                            <input type="number" id="actual_stock_{{ $stock->product_id }}" 
                                   class="border rounded p-2 w-full" 
                                   value="{{ $calculatedStock }}">
                        </td>
                        <td class="border p-3 text-center" id="difference_{{ $stock->product_id }}">0</td>
                        <td class="border p-3">
                            <form action="{{ route('manager.stock_transactions.stock_opname.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $stock->product_id }}">
                                <input type="hidden" id="hidden_actual_stock_{{ $stock->product_id }}" name="actual_stock">
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Adjust Stock
                                </button>
                            </form>
                        </td>
                    </tr>
                    <script>
                        document.getElementById("actual_stock_{{ $stock->product_id }}").addEventListener("input", function() {
                            let actual = parseInt(this.value);
                            let systemStock = {{ $calculatedStock }};
                            let difference = actual - systemStock;
                            document.getElementById("difference_{{ $stock->product_id }}").innerText = difference;
                            document.getElementById("hidden_actual_stock_{{ $stock->product_id }}").value = actual;
                        });
                    </script>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
