@extends('admin.navbar')

@section('title', 'Daftar Kategori')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Kategori</h1>

    <!-- Tombol Tambah Kategori -->
    <a href="{{ route('admin.categories.create') }}" 
        class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
        + Tambah Kategori
    </a>

    <!-- Tabel Kategori -->
    <div class="mt-6 bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border">ID</th>
                    <th class="px-4 py-3 border">Nama</th>
                    <th class="px-4 py-3 border">Deskripsi</th>
                    <th class="px-4 py-3 border">Dibuat</th>
                    <th class="px-4 py-3 border">Diperbarui</th>
                    <th class="px-4 py-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 border">{{ $category->id }}</td>
                    <td class="px-4 py-3 border">{{ $category->name }}</td>
                    <td class="px-4 py-3 border">{{ $category->description }}</td>
                    <td class="px-4 py-3 border">{{ $category->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 border">{{ $category->updated_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 border text-center flex justify-center space-x-2">
                        <!-- Tombol Lihat -->
                        <a href="{{ route('admin.categories.show', $category->id) }}" 
                            class="bg-blue-500 text-white px-3 py-2 rounded-md text-sm shadow-sm hover:bg-blue-700 transition">
                            Lihat
                        </a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                            class="bg-yellow-500 text-white px-3 py-2 rounded-md text-sm shadow-sm hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-600 text-white px-3 py-2 rounded-md text-sm shadow-sm hover:bg-red-700 transition">
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
@endsection
