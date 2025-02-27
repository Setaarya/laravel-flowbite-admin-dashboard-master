<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Services\SupplierService;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->supplierService->validateSupplierData($request);
        $this->supplierService->createSupplier($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $this->supplierService->validateSupplierData($request);
        $this->supplierService->updateSupplier($supplier, $validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $this->supplierService->deleteSupplier($supplier);

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
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
}
