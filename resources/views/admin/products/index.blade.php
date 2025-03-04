@extends('admin.navbar')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Daftar Produk</h1>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <div class="flex space-x-2">
            <!-- Tombol Tambah Produk -->
            <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Tambah Produk
            </a>
    
            <!-- Tombol Export Produk -->
            <a href="{{ route('admin.export.products') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Export Produk
            </a>
        </div>
    
        <div class="flex space-x-2">
            <!-- Tombol Tambah Kategori Baru -->
            <a href="{{ route('admin.categories.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Tambah Kategori Baru
            </a>
    
            <!-- Tombol Tambah Atribut Produk -->
            <a href="{{ route('admin.product_attributes.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                Tambah Atribut Produk
            </a>
        </div>
    </div>    

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
                    <th class="px-4 py-2 border">Stok Saat Ini</th>
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
                    <td class="py-3 px-4 border">{{ str()->limit($product->description, 50) }}</td>
                    <td class="py-3 px-4 border">Rp {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                    <td class="py-3 px-4 border">Rp {{ number_format($product->selling_price, 2, ',', '.') }}</td>
                    
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
                    <td class="py-3 px-4 border">{{ $product->minimum_stock }}</td>
                    <td class="py-3 px-4 border flex space-x-2">
                        <!-- Tombol Show -->
                        <a href="{{ route('products.show', $product->id) }}"
                            class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                            Show
                        </a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600">
                            Edit
                        </a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
@endsection

