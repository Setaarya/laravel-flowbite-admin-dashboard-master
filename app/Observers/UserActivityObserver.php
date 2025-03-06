<?php

namespace App\Observers;

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class UserActivityObserver
{
    protected function logActivity($activity)
    {
        if (Auth::check()) {
            UserActivity::create([
                'user_id'   => Auth::id(), // Tambahkan user_id
                'username' => Auth::user()->name,
                'activity' => $activity,
                'created_at' => now(),
            ]);
        }
    }

    public function created($model)
    {
        $this->logActivity("Created a new " . class_basename($model) . " with ID: " . $model->id);
    }

    public function updated($model)
    {
        $this->logActivity("Updated " . class_basename($model) . " with ID: " . $model->id);
    }

    public function deleted($model)
    {
        $this->logActivity("Deleted " . class_basename($model) . " with ID: " . $model->id);
    }

    public function restored($model)
    {
        $this->logActivity("Restored " . class_basename($model) . " with ID: " . $model->id);
    }

    public function forceDeleted($model)
    {
        $this->logActivity("Permanently deleted " . class_basename($model) . " with ID: " . $model->id);
    }
}
