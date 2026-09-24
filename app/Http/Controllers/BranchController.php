<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;
use App\Models\Status;
use App\Services\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct(protected BranchService $branches)
    {
    }

    /**
     * Display a listing of branches.
     */
    public function index(Request $request)
    {
        $branches = $this->branches->paginate($request);
        $areas = $this->branches->areas();

        return view('branches.index', compact('branches', 'areas'));
    }

    /**
     * Show the form for creating a new branch.
     */
    public function create()
    {
        $statuses = Status::orderBy('name')->get();

        return view('branches.create', compact('statuses'));
    }

    /**
     * Store a newly created branch.
     */
    public function store(StoreBranchRequest $request)
    {
        $this->branches->create($request->validated());

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified branch.
     */
    public function edit(Branch $branch)
    {
        $branch->loadMissing(['address', 'currentStatusLog']);

        $statuses = Status::orderBy('name')->get();

        return view('branches.edit', compact('branch', 'statuses'));
    }

    /**
     * Update the specified branch.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $this->branches->update($branch, $request->validated());

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch berhasil diperbarui.');
    }

    /**
     * Remove the specified branch.
     */
    public function destroy(Branch $branch)
    {
        $this->branches->delete($branch);

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch berhasil dihapus.');
    }
}