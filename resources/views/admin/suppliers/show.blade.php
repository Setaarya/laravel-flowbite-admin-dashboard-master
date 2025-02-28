@extends('admin.navbar')

@section('title', 'Detail Supplier')

@section('content')
    <h1 class="text-center text-gray-800 text-2xl font-bold mb-4">Supplier Details</h1>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="w-full border-collapse border border-gray-300 mb-4">
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">ID</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->id }}</td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">Name</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->name }}</td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">Email</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->email }}</td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">Phone</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->phone }}</td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">Address</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->address }}</td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">Created At</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->created_at }}</td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-gray-700">Updated At</th>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->updated_at }}</td>
            </tr>
        </table>
        <div class="flex space-x-2">
            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Supplier
            </a>
            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete Supplier
                </button>
            </form>
        </div>
    </div>
@endsection
