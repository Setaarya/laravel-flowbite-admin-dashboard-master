@extends('admin.navbar')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Daftar Pengguna</h1>

    <!-- Tombol Tambah Pengguna -->
    <div class="flex justify-between mb-6">
        <a href="{{ route('admin.users.create') }}" 
            class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition">
            + Tambah Pengguna
        </a>
    </div>

    <!-- Tabel Pengguna -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border">ID</th>
                    <th class="px-4 py-3 border">Nama</th>
                    <th class="px-4 py-3 border">Email</th>
                    <th class="px-4 py-3 border">Role</th>
                    <th class="px-4 py-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 border">{{ $user->id }}</td>
                    <td class="px-4 py-3 border">{{ $user->name }}</td>
                    <td class="px-4 py-3 border">{{ $user->email }}</td>
                    <td class="px-4 py-3 border">{{ $user->role }}</td>
                    <td class="px-4 py-3 border text-center flex justify-center space-x-2">
                        <!-- Tombol Show -->
                        <a href="{{ route('admin.users.show', $user->id) }}" 
                            class="bg-blue-500 text-white px-3 py-2 rounded-md text-sm shadow-sm hover:bg-blue-700 transition">
                            Lihat
                        </a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                            class="bg-yellow-500 text-white px-3 py-2 rounded-md text-sm shadow-sm hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
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
