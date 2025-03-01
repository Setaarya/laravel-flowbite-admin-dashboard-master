@extends('admin.navbar')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Barang Masuk & Keluar</h2>

    <!-- Filter Form -->
    <form action="{{ route('transaction.report') }}" method="GET">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date">Tanggal Akhir:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <hr>

    <!-- Export Buttons -->
    <div class="d-flex justify-content-between mb-3">
        <h4>Hasil Laporan</h4>
        <div>
            <a href="{{ route('export.transaction.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success">
                Export Excel
            </a>
            <a href="{{ route('export.transaction.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-danger">
                Export PDF
            </a>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tipe</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->product->name ?? 'Tidak Ada Produk' }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>
                        @if ($transaction->type == 'in')
                            <span class="badge bg-success">Masuk</span>
                        @else
                            <span class="badge bg-danger">Keluar</span>
                        @endif
                    </td>
                    <td>{{ $transaction->transaction_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
