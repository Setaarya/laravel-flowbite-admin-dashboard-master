<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;

use App\Services\SupplierService;

use Illuminate\Http\Request;


class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function managerIndex()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        return view('manager.suppliers.index', compact('suppliers'));
    }

    public function adminindex()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function admincreate()
    {
        return view('admin.suppliers.create');
    }

    public function adminstore(Request $request)
    {
        $validatedData = $this->supplierService->validateSupplierData($request);
        $this->supplierService->createSupplier($validatedData);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function adminshow($supplierId)
    {
        $supplier = $this->supplierService->getSupplierById($supplierId);
        return view('admin.suppliers.show', compact('supplier'));
    }

    public function adminedit($supplierId)
    {
        $supplier = $this->supplierService->getSupplierById($supplierId);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function adminupdate(Request $request, $supplierId)
    {
        $validatedData = $this->supplierService->validateSupplierData($request);
        $this->supplierService->updateSupplier($supplierId, $validatedData);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function admindestroy($supplierId)
    {
        $this->supplierService->deleteSupplier($supplierId);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
