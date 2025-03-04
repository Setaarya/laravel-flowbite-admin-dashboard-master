@extends('admin.navbar')

@section('title', 'Detail Kategori')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Detail Kategori</h1>

    <div class="mb-4">
        <a href="{{ route('admin.categories.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
            &larr; Kembali ke Daftar Kategori
        </a>
    </div>

    <div class="border rounded-lg overflow-hidden">
        <table class="min-w-full bg-white border border-gray-200">
            <tbody>
                <tr class="border-b">
                    <th class="text-left px-4 py-3 bg-gray-100 text-gray-700">ID</th>
                    <td class="px-4 py-3">{{ $category->id }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-3 bg-gray-100 text-gray-700">Nama</th>
                    <td class="px-4 py-3">{{ $category->name }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-3 bg-gray-100 text-gray-700">Deskripsi</th>
                    <td class="px-4 py-3">{{ $category->description }}</td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-4 py-3 bg-gray-100 text-gray-700">Dibuat Pada</th>
                    <td class="px-4 py-3">{{ $category->created_at }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-3 bg-gray-100 text-gray-700">Diperbarui Pada</th>
                    <td class="px-4 py-3">{{ $category->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex space-x-4 mt-6">
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
            Edit Kategori
        </a>

        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                Hapus Kategori
            </button>
        </form>
    </div>
</div>
@endsection
