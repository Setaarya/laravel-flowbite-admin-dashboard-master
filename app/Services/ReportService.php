<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService
{
    protected $repository;

    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function generateReport($categoryId = null, $startDate = null, $endDate = null)
    {
        return $this->repository->getReport($categoryId, $startDate, $endDate);
    }

    public function getReportData($filters = [])
    {
        return $this->repository->getFilteredProducts($filters);
    }
}
