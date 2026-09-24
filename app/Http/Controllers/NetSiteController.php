<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNetSiteRequest;
use App\Http\Requests\UpdateNetSiteRequest;
use App\Models\NetSite;
use App\Services\NetSiteService;

class NetSiteController extends Controller
{
    public function __construct(protected NetSiteService $netSites)
    {
    }

    public function index()
    {
        $netSites = $this->netSites->paginate();

        return view('net_sites.index', compact('netSites'));
    }

    public function create()
    {
        $branches = $this->netSites->branchesForForm();
        $vendors = $this->netSites->vendorsForForm();
        $statuses = $this->netSites->statusesForForm();

        return view('net_sites.create', compact(
            'branches',
            'vendors',
            'statuses'
        ));
    }

    public function store(StoreNetSiteRequest $request)
    {
        $this->netSites->create($request->validated());

        return redirect()
            ->route('net-sites.index')
            ->with('success', 'Net Site berhasil ditambahkan.');
    }

    public function edit(NetSite $netSite)
    {
        $netSite->loadMissing('currentStatusLog');

        $branches = $this->netSites->branchesForForm();
        $vendors = $this->netSites->vendorsForForm();
        $statuses = $this->netSites->statusesForForm();

        return view('net_sites.edit', compact(
            'netSite',
            'branches',
            'vendors',
            'statuses'
        ));
    }

    public function update(UpdateNetSiteRequest $request, NetSite $netSite)
    {
        $this->netSites->update($netSite, $request->validated());

        return redirect()
            ->route('net-sites.index')
            ->with('success', 'Net Site berhasil diperbarui.');
    }

    public function destroy(NetSite $netSite)
    {
        $this->netSites->delete($netSite);

        return redirect()
            ->route('net-sites.index')
            ->with('success', 'Net Site berhasil dihapus.');
    }
}