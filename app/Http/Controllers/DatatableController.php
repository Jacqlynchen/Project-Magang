<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DatatableController extends Controller
{
    public function __invoke(Request $request, string $table)
    {
        $class = "App\\Actions\\Datatable\\"
            . Str::studly(Str::singular($table))
            . "Table";

        abort_unless(class_exists($class), 404);

        return app($class)->handle($request->all());
    }
}