@extends('admin.navbar')

@section('title', 'Daftar Supplier')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Daftar Supplier</h1>

    <div class="flex justify-between mb-4">
        <a href="{{ route('suppliers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Tambah Supplier
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border">ID</th>
                    <th class="py-3 px-4 border">Nama</th>
                    <th class="py-3 px-4 border">Email</th>
                    <th class="py-3 px-4 border">Telepon</th>
                    <th class="py-3 px-4 border">Alamat</th>
                    <th class="py-3 px-4 border">Dibuat</th>
                    <th class="py-3 px-4 border">Diperbarui</th>
                    <th class="py-3 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr class="border-t">
                    <td class="py-3 px-4 border">{{ $supplier->id }}</td>
                    <td class="py-3 px-4 border">{{ $supplier->name }}</td>
                    <td class="py-3 px-4 border">{{ $supplier->email }}</td>
                    <td class="py-3 px-4 border">{{ $supplier->phone }}</td>
                    <td class="py-3 px-4 border">{{ $supplier->address }}</td>
                    <td class="py-3 px-4 border">{{ $supplier->created_at }}</td>
                    <td class="py-3 px-4 border">{{ $supplier->updated_at }}</td>
                    <td class="py-3 px-4 border flex space-x-2">
                        <!-- Tombol Show -->
                        <a href="{{ route('suppliers.show', $supplier->id) }}"
                            class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                            Show
                        </a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600">
                            Edit
                        </a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');">
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
@endsection
