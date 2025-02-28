@extends('manager.navbar')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Daftar Produk</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border">ID</th>
                    <th class="py-3 px-4 border">Kategori</th>
                    <th class="py-3 px-4 border">Supplier</th>
                    <th class="py-3 px-4 border">Nama</th>
                    <th class="py-3 px-4 border">SKU</th>
                    <th class="py-3 px-4 border">Deskripsi</th>
                    <th class="py-3 px-4 border">Harga Beli</th>
                    <th class="py-3 px-4 border">Harga Jual</th>
                    <th class="py-3 px-4 border">Gambar</th>
                    <th class="py-3 px-4 border">Stok Saat Ini</th>
                    <th class="py-3 px-4 border">Stok Minimum</th>
                    <th class="py-3 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="border-t">
                    <td class="py-3 px-4 border">{{ $product->id }}</td>
                    <td class="py-3 px-4 border">{{ $product->category->name }}</td>
                    <td class="py-3 px-4 border">{{ $product->supplier->name }}</td>
                    <td class="py-3 px-4 border">{{ $product->name }}</td>
                    <td class="py-3 px-4 border">{{ $product->sku }}</td>
                    <td class="py-3 px-4 border">{{ Str::limit($product->description, 50) }}</td>
                    <td class="py-3 px-4 border">Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                    <td class="py-3 px-4 border">Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>
                    <td class="py-3 px-4 border text-center">
                        @if ($product->image)
                            <button onclick="showImage('{{ asset('storage/' . $product->image) }}')" 
                                    class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                                Lihat Gambar
                            </button>
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 border">{{ $product->current_stock }}</td>
                    <td class="py-3 px-4 border">{{ $product->minimum_stock }}</td>
                    <td class="py-3 px-4 border flex space-x-2">
                        <a href="{{ route('manager.products.show', $product->id) }}" 
                           class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">
                            Show
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk menampilkan gambar -->
<div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex items-center justify-center">
    <div class="bg-white p-4 rounded-lg shadow-lg relative">
        <button onclick="closeImage()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-md">
            X
        </button>
        <img id="modalImage" src="" class="max-w-full max-h-screen rounded-lg">
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
