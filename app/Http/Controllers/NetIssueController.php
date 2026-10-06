<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNetIssueRequest;
use App\Http\Requests\UpdateNetIssueRequest;
use App\Models\NetIssue;
use App\Services\NetIssueService;
use Illuminate\Http\Request;

class NetIssueController extends Controller
{
    public function __construct(protected NetIssueService $netIssues)
    {
    }

    public function index(Request $request)
    {
        $netIssues = $this->netIssues->paginate($request);

        return view('net_issues.index', compact('netIssues'));
    }

    public function create()
    {
        return view('net_issues.create');
    }

    public function store(StoreNetIssueRequest $request)
    {
        $this->netIssues->create($request->validated());

        return redirect()
            ->route('net-issues.index')
            ->with('success', 'Issue type berhasil ditambahkan.');
    }

    public function edit(NetIssue $netIssue)
    {
        return view('net_issues.edit', compact('netIssue'));
    }

    public function update(UpdateNetIssueRequest $request, NetIssue $netIssue)
    {
        $this->netIssues->update($netIssue, $request->validated());

        return redirect()
            ->route('net-issues.index')
            ->with('success', 'Issue type berhasil diperbarui.');
    }

    public function destroy(NetIssue $netIssue)
    {
        $this->netIssues->delete($netIssue);

        return redirect()
            ->route('net-issues.index')
            ->with('success', 'Issue type berhasil dihapus.');
    }
}