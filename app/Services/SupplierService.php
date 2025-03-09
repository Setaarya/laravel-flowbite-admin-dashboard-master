<?php

namespace App\Services;

use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;

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
    public function updateSupplier(int $supplierId, array $data)
    {
        return $this->supplierRepository->update($supplierId, $data);
    }

    /**
     * Menghapus supplier.
     */
    public function deleteSupplier(int $supplierId)
    {
        return $this->supplierRepository->delete($supplierId);
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
