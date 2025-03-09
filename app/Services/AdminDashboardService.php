<?php

namespace App\Services;

use App\Repositories\AdminDashboardRepositoryInterface;

class AdminDashboardService
{
    protected $repository;

    public function __construct(AdminDashboardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getDashboardData($startDate, $endDate, int $limit = 5 ): array
    {
        return [
            'total_products' => $this->repository->getTotalProducts(),
            'incoming_transactions' => $this->repository->getIncomingTransactions(),
            'outgoing_transactions' => $this->repository->getOutgoingTransactions(),
            'total_transactions' => $this->repository->getTotalTransactions(),
            'total_suppliers' => $this->repository->getTotalSuppliers(),
            'total_users' => $this->repository->getTotalUsers(),
            'low_stock' => $this->repository->getLowStockCount(),
            'latest_user_activities' => $this->repository->getLatestUserActivities($limit),
            'stock_levels' => $this->repository->getStockLevels(),
        ];
    }
}
