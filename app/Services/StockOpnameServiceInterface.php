<?php

namespace App\Services;

interface StockOpnameServiceInterface
{
    public function getStockOpnameData();
    public function updateStockOpname($productId, $manualCount);
}
