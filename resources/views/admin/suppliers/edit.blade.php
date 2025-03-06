@extends('admin.navbar')

@section('title', 'Ubah Data Supplier')


@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Edit Supplier</h1>
        
        <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" name="name" value="{{ $supplier->name }}" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Email:</label>
                <input type="email" name="email" value="{{ $supplier->email }}" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Phone:</label>
                <input type="text" name="phone" value="{{ $supplier->phone }}" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Address:</label>
                <textarea name="address" rows="3"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $supplier->address }}</textarea>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                Update
            </button>
        </form>
    </div>
@endsection
