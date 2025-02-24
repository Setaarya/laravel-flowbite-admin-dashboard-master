<?php

namespace App\Services;

use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers()
    {
        return $this->supplierRepository->getAll();
    }

    public function createSupplier(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    public function updateSupplier(Supplier $supplier, array $data)
    {
        return $this->supplierRepository->update($supplier, $data);
    }

    public function deleteSupplier(Supplier $supplier)
    {
        return $this->supplierRepository->delete($supplier);
    }

    public function validateSupplierData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:suppliers,email,' . $request->id,
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
    }
}
