<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct(protected VendorService $vendors)
    {
    }

    /**
     * Display a listing of vendors.
     */
    public function index(Request $request)
    {
        $vendors = $this->vendors->paginate($request);

        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created vendor.
     */
    public function store(StoreVendorRequest $request)
    {
        $this->vendors->create($request->validated());

        return redirect()
            ->route('vendors.index')
            ->with('success', 'Vendor berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified vendor.
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified vendor.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $this->vendors->update($vendor, $request->validated());

        return redirect()
            ->route('vendors.index')
            ->with('success', 'Vendor berhasil diperbarui.');
    }

    /**
     * Remove the specified vendor.
     */
    public function destroy(Vendor $vendor)
    {
        $this->vendors->delete($vendor);

        return redirect()
            ->route('vendors.index')
            ->with('success', 'Vendor berhasil dihapus.');
    }
}