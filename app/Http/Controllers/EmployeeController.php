<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function edit(User $employee): View
    {
        return view('employees.edit')
            ->with('employee', $employee);
    }
}
