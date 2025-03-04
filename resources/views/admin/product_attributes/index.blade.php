@extends('admin.navbar')

@section('title', 'Daftar Attribute Produk')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Daftar Atribut Produk</h1>

    <div class="flex justify-between mb-4">
        <a href="{{ route('admin.product_attributes.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Tambah Atribut
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Produk</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Atribut</th>
                    <th class="border border-gray-300 px-4 py-2">Nilai</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attributes as $attribute)
                <tr class="border border-gray-300">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $attribute->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attribute->product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attribute->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attribute->value }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center flex space-x-2 justify-center">
                        <a href="{{ route('admin.product_attributes.show', $attribute->id) }}" 
                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Lihat
                        </a>
                        <a href="{{ route('admin.product_attributes.edit', $attribute->id) }}" 
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.product_attributes.destroy', $attribute->id) }}" method="POST" 
                              onsubmit="return confirmDelete(event)" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(event) {
        event.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus atribut ini?')) {
            event.target.closest('form').submit();
        }
    }
</script>
@endsection
