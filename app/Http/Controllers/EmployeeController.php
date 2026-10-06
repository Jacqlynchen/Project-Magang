<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employees)
    {
    }

    /**
     * Display a listing of employees.
     *
     * Read-only by design — employee data is meant to come from the
     * EmployeeSeeder / EmployeeFactory (simulating an external HR
     * system), not typed in through this app.
     */
    public function index(Request $request)
    {
        $employees = $this->employees->paginate($request);

        return view('employees.index', compact('employees'));
    }
}