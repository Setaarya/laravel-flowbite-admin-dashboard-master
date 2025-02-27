@extends('manager.navbar')

@section('title', 'Daftar Produk')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Daftar Produk</h1>

    <table class="w-full bg-white border border-gray-200 shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Kategori</th>
                <th class="px-4 py-2 border">Supplier</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">SKU</th>
                <th class="px-4 py-2 border">Deskripsi</th>
                <th class="px-4 py-2 border">Harga Beli</th>
                <th class="px-4 py-2 border">Harga Jual</th>
                <th class="px-4 py-2 border">Gambar</th>
                <th class="px-4 py-2 border">Stok Saat Ini</th>
                <th class="px-4 py-2 border">Stok Minimum</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border">
                <td class="px-4 py-2 border">{{ $product->id }}</td>
                <td class="px-4 py-2 border">{{ $product->category->name }}</td>
                <td class="px-4 py-2 border">{{ $product->supplier->name }}</td>
                <td class="px-4 py-2 border">{{ $product->name }}</td>
                <td class="px-4 py-2 border">{{ $product->sku }}</td>
                <td class="px-4 py-2 border">{{ Str::limit($product->description, 50) }}</td>
                <td class="px-4 py-2 border">Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                <td class="px-4 py-2 border">Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>
                <td class="px-4 py-2 border text-center">
                    @if ($product->image)
                        <button onclick="showImage('{{ asset('storage/' . $product->image) }}')" 
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Lihat Gambar
                        </button>
                    @else
                        <span class="text-gray-500">No Image</span>
                    @endif
                </td>
                <td class="px-4 py-2 border">{{ $product->current_stock }}</td>
                <td class="px-4 py-2 border">{{ $product->minimum_stock }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('manager.products.show', $product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Show</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk menampilkan gambar -->
<div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex items-center justify-center">
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <button onclick="closeImage()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded">X</button>
        <img id="modalImage" src="" class="max-w-lg max-h-screen rounded">
    </div>
</div>

<script>
    function showImage(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImage() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
<!-- Modal untuk menampilkan gambar -->
<div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex items-center justify-center">
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <button onclick="closeImage()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded">X</button>
        <img id="modalImage" src="" class="max-w-lg max-h-screen rounded">
    </div>
</div>

<script>
    function showImage(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImage() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>

@endsection
