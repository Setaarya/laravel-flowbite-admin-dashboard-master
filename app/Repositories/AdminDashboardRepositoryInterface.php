<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AdminDashboardRepositoryInterface
{
    public function getTotalProducts(): int;
    public function getIncomingTransactions(): int;
    public function getOutgoingTransactions(): int;
    public function getTotalTransactions(): int;
    public function getTotalSuppliers(): int;
    public function getTotalUsers(): int;
    public function getLowStockCount(): int;
    public function getLatestUserActivities(int $limit);
    public function getStockLevels();
}