<?php

namespace App\Repositories;

interface StockOpnameRepositoryInterface
{
    public function getStockOpnameData();
    public function updateStockOpname($productId, $manualCount);
}
