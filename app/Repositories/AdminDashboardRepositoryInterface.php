<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AdminDashboardRepositoryInterface
{
    public function getTotalProducts(): int;
    public function getTransactionsCount($startDate, $endDate, $type): int;
    public function getStockLevels(): Collection;
    public function getLatestUserActivities(): Collection;
}
