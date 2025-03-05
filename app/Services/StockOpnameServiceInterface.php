<?php

namespace App\Services;

interface StockOpnameServiceInterface
{
    public function getStockOpnameData();
    public function updateManualCount($id, $manualCount);
    public function findById($id);
    public function saveStockOpname($stockData);
    public function getLatestStockOpname();
    public function adjustStock($id, $adjustmentValue);
    public function adminexportToExcel();
}
