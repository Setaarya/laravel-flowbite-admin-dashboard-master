<?php

namespace App\Services;

interface AdminDashboardServiceInterface
{
    public function getDashboardData($startDate, $endDate): array;
}
