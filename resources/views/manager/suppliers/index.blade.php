@extends('manager.navbar')

@section('title', 'Daftar Supplier')

@section('content')
    <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Suppliers List</h1>

    <table class="w-full border-collapse border border-gray-300 bg-white shadow-md">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Phone</th>
                <th class="border border-gray-300 px-4 py-2">Address</th>
                <th class="border border-gray-300 px-4 py-2">Created At</th>
                <th class="border border-gray-300 px-4 py-2">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
            <tr class="border border-gray-300 text-gray-700">
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->email }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->phone }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->address }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->created_at }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $supplier->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
