<?php

namespace App\Repositories;

interface StockOpnameRepositoryInterface
{
    public function getAllStockOpname();
    public function updateManualCount($id, $manualCount);
    public function findById($id);
    public function saveStockOpname($stockData);
    public function getLatestStockOpname();
    public function adjustStock($id, $adjustmentValue);
    public function getLatestStockOpnameAdmin();
}
