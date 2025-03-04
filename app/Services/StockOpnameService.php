<?php

namespace App\Services;

use App\Repositories\StockOpnameRepositoryInterface;

class StockOpnameService implements StockOpnameServiceInterface
{
    protected $stockOpnameRepository;

    public function __construct(StockOpnameRepositoryInterface $stockOpnameRepository)
    {
        $this->stockOpnameRepository = $stockOpnameRepository;
    }

    public function getStockOpnameData()
    {
        return $this->stockOpnameRepository->getStockOpnameData();
    }

    public function updateStockOpname($productId, $manualCount)
    {
        return $this->stockOpnameRepository->updateStockOpname($productId, $manualCount);
    }
}
