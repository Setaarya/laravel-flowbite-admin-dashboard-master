@extends('admin.navbar')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold mb-4">User Activity Log</h2>

        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr class="text-left border-b">
                        <th class="p-3">Username</th>
                        <th class="p-3">Activity</th>
                        <th class="p-3">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr class="border-b">
                            <td class="p-3">{{ $activity->user->name }}</td>
                            <td class="p-3">{{ $activity->activity }}</td>
                            <td class="p-3">{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
@endsection
