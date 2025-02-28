@extends('staff.navbar')

@section('title', 'Dashboard Staff')

@section('content')
<header class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard Staff</h1>
    </div>
</header>

<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold">Welcome, {{ auth()->user()->name }}!</h2>
    <p class="mb-4">Berikut adalah daftar tugas Anda.</p>

    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <!-- Barang Masuk -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Masuk yang Perlu Diperiksa</h3>
            <ul class="space-y-2">
                @forelse ($tasks['barang_masuk'] as $task)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm flex justify-between items-center">
                        <div>
                            <span class="font-semibold">{{ $task->product->name }}</span> - 
                            <span>{{ $task->quantity }}</span>
                        </div>
                        <button 
                            onclick="confirmTransaction({{ $task->id }}, 'received')"
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700"
                        >
                            Konfirmasi Terima
                        </button>
                    </li>
                @empty
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm text-gray-500">Tidak ada barang masuk.</li>
                @endforelse
            </ul>
        </div>

        <!-- Barang Keluar -->
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-600">Barang Keluar yang Perlu Disiapkan</h3>
            <ul class="space-y-2">
                @forelse ($tasks['barang_keluar'] as $task)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm flex justify-between items-center">
                        <div>
                            <span class="font-semibold">{{ $task->product->name }}</span> - 
                            <span>{{ $task->quantity }}</span>
                        </div>
                        <button 
                            onclick="confirmTransaction({{ $task->id }}, 'dispatched')"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Konfirmasi Kirim
                        </button>
                    </li>
                @empty
                    <li class="p-4 bg-gray-100 rounded-lg shadow-sm text-gray-500">Tidak ada barang keluar.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- JavaScript untuk konfirmasi transaksi -->
<script>
    function confirmTransaction(transactionId, status) {
        if (!confirm('Apakah Anda yakin ingin mengonfirmasi transaksi ini?')) {
            return;
        }

        fetch(`/stock-transactions/${transactionId}/confirm`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                location.reload();
            } else if (data.error) {
                alert(data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection
