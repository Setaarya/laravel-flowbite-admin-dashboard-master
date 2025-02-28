@extends('admin.navbar')

@section('title', 'Buat Supplier Baru')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Create Supplier</h1>
        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Name:</label>
                <input type="text" name="name" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Phone:</label>
                <input type="text" name="phone" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Address:</label>
                <textarea name="address" 
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <button type="submit"
                class="w-full p-2 bg-blue-600 text-white font-bold rounded hover:bg-blue-700 transition">
                Create
            </button>
        </form>
    </div>
@endsection
