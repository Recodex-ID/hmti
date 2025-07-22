<?php

namespace App\Http\Controllers;

use App\Models\Department;

class DepartemenController extends Controller
{
    public function show(Department $department)
    {
        $department->load(['departmentFunctions', 'workPrograms', 'activeMembers', 'headMembers']);

        return view('departemen.show', compact('department'));
    }
}
