<?php
namespace App\Repositories;

use App\Models\UserActivity;

class UserActivityRepository
{
    public function getAll()
    {
        return UserActivity::with('user')->latest()->paginate(10);
    }

    public function create($userId, $activity)
    {
        return UserActivity::create([
            'user_id' => $userId,
            'activity' => $activity,
        ]);
    }
}
?>