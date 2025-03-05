<?php

namespace App\Services;

use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Validation\Rule;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Mendapatkan semua supplier.
     */
    public function getAllSuppliers()
    {
        return $this->supplierRepository->getAll();
    }


    /**
     * Mendapatkan detail supplier berdasarkan ID.
     */
    public function getSupplierById(int $supplierId)
    {
        return $this->supplierRepository->getById($supplierId);
    }

    /**
     * Membuat supplier baru.
     */
    public function createSupplier(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    /**
     * Memperbarui data supplier.
     */
    public function updateSupplier(Supplier $supplier, array $data)
    {
        return $this->supplierRepository->update($supplier, $data);
    }

    /**
     * Menghapus supplier.
     */
    public function deleteSupplier(Supplier $supplier)
    {
        return $this->supplierRepository->delete($supplier);
    }

    /**
     * Validasi data supplier.
     */
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
