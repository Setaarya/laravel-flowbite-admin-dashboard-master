<?php
namespace App\Services;

use App\Repositories\UserActivityRepository;

class UserActivityService
{
    protected $userActivityRepository;

    public function __construct(UserActivityRepository $userActivityRepository)
    {
        $this->userActivityRepository = $userActivityRepository;
    }

    public function getAllActivities()
    {
        return $this->userActivityRepository->getAll();
    }

    public function logActivity($userId, $activity)
    {
        return $this->userActivityRepository->create($userId, $activity);
    }
}

?>