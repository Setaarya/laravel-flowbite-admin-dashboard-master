<?php

namespace App\Services;

use App\Repositories\ManagerDashboardRepository;

class ManagerDashboardService
{
    protected $stockRepository;

    public function __construct(ManagerDashboardRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function getDashboardData()
    {
        return [
            'low_stock_products' => $this->stockRepository->getLowStockProducts(),
            'incoming_stock_today' => $this->stockRepository->getIncomingStockToday(),
            'outgoing_stock_today' => $this->stockRepository->getOutgoingStockToday(),
        ];
    }
}
