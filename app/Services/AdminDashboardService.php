<?php

namespace App\Services;

use App\Repositories\AdminDashboardRepositoryInterface;

class AdminDashboardService implements AdminDashboardServiceInterface
{
    protected $repository;

    public function __construct(AdminDashboardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getDashboardData($startDate, $endDate): array
    {
        return [
            'total_products' => $this->repository->getTotalProducts(),
            'incoming_transactions' => $this->repository->getTransactionsCount($startDate, $endDate, 'masuk'),
            'outgoing_transactions' => $this->repository->getTransactionsCount($startDate, $endDate, 'keluar'),
            'stock_levels' => $this->repository->getStockLevels(),
            'latest_user_activities' => $this->repository->getLatestUserActivities(),
        ];
    }
}
