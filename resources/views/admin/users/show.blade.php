@extends('admin.navbar')

@section('title', 'Detail Pengguna')

@section('content')
<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h1 class="text-center text-xl font-bold text-gray-700 mb-4">Show User</h1>
        <div>
            <label class="font-bold text-gray-700">ID:</label>
            <span class="block p-2 border border-gray-300 rounded-lg bg-gray-100">{{ $user->id }}</span>
        </div>
        <div>
            <label class="font-bold text-gray-700">Name:</label>
            <span class="block p-2 border border-gray-300 rounded-lg bg-gray-100">{{ $user->name }}</span>
        </div>
        <div>
            <label class="font-bold text-gray-700">Email:</label>
            <span class="block p-2 border border-gray-300 rounded-lg bg-gray-100">{{ $user->email }}</span>
        </div>
        <div>
            <label class="font-bold text-gray-700">Role:</label>
            <span class="block p-2 border border-gray-300 rounded-lg bg-gray-100">{{ $user->role }}</span>
        </div>
    </div>
</div>
@endsection
