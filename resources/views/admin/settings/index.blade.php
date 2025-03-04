@extends('admin.navbar')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Pengaturan Umum</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="app_name" class="block font-medium">Nama Aplikasi</label>
            <input type="text" id="app_name" name="app_name" value="{{ $settings?->app_name }}" 
                class="w-full border-gray-300 rounded-md p-2 mt-1">
        </div>

        <div class="mb-4">
            <label for="app_logo" class="block font-medium">Logo Aplikasi</label>
            <input type="file" id="app_logo" name="app_logo" class="w-full border-gray-300 rounded-md p-2 mt-1">
            @if($settings->app_logo)
                <img src="{{ asset('storage/' . $settings->app_logo) }}" class="mt-3 h-16">
            @endif
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
