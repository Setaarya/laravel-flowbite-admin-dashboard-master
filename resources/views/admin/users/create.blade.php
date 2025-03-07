@extends('admin.navbar')

@section('title', 'Buat Data Pengguna Baru')

@section('content')
<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h1 class="text-center text-xl font-bold text-gray-700 mb-4">Create User</h1>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div>
                <label class="block text-gray-700">Name:</label>
                <input type="text" name="name" required 
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" required 
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700">Password:</label>
                <input type="password" name="password" required 
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700">Confirm Password:</label>
                <input type="password" name="password_confirmation" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700">Role:</label>
                <select name="role" required 
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                    <option value="Admin">Admin</option>
                    <option value="Staff Gudang">Staff Gudang</option>
                    <option value="Manajer Gudang">Manajer Gudang</option>
                </select>
            </div>
            <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mt-4">
                Create
            </button>
        </form>
    </div>
</div>
@endsection
