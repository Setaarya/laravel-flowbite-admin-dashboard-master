<?php

namespace App\Services;

use App\Repositories\StaffDashboardRepositoryInterface;

class StaffDashboardService
{
    protected $repository;

    public function __construct(StaffDashboardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getTasks(): array
    {
        return [
            'barang_masuk' => $this->repository->getPendingIncomingStock(),
            'barang_keluar' => $this->repository->getPendingOutgoingStock(),
            'konfirmasi_penerimaan' => $this->repository->getReceivedStock(),
            'konfirmasi_pengeluaran' => $this->repository->getDispatchedStock(),
        ];
    }
}
