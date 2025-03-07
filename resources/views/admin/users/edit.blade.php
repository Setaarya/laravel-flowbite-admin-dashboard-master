@extends('admin.navbar')

@section('title', 'Edit Data Pengguna')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-md w-96">
            <h1 class="text-xl font-bold text-center mb-4 text-gray-700">Edit User</h1>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700">Name:</label>
                    <input type="text" name="name" value="{{ $user->name }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Password:</label>
                    <input type="password" name="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700">Confirm Password:</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Role:</label>
                    <select name="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Staff Gudang" {{ $user->role == 'Staff Gudang' ? 'selected' : '' }}>Staff Gudang</option>
                        <option value="Manajer Gudang" {{ $user->role == 'Manajer Gudang' ? 'selected' : '' }}>Manajer Gudang</option>
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
