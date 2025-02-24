<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface StaffDashboardRepositoryInterface
{
    public function getPendingIncomingStock(): Collection;
    public function getPendingOutgoingStock(): Collection;
    public function getReceivedStock(): Collection;
    public function getDispatchedStock(): Collection;
    public function getLowStockItems(): Collection;
    public function itemsInToday(): Collection;
    public function itemsOutToday(): Collection;
}
