<?php
namespace App\Services;

use App\Repositories\StaffDashboardRepository;

class StockService
{
    protected $repository;

    public function __construct(StaffDashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDashboardData()
    {
        return [
            'low_stock' => $this->repository->getLowStockItems(),
            'in_today' => $this->repository->itemsInToday(),
            'out_today' => $this->repository->itemsOutToday(),
        ];
    }
}
