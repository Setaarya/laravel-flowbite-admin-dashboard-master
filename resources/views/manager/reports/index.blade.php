@extends('manager.navbar')

@section('content')
<div class="container mx-auto text-center py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Laporan Stok & Transaksi</h2>

    <div class="flex flex-col items-center space-y-4">
        <a href="{{ route('manager.reports.stock_report') }}" 
            class="w-64 py-4 text-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md transition duration-300">
            Laporan Transaksi
        </a>
        
        <a href="{{ route('manager.reports.transaction_report') }}" 
            class="w-64 py-4 text-lg font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-md transition duration-300">
            Laporan Stok
        </a>
    </div>
</div>
@endsection
