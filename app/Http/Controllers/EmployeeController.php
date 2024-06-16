<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function show(User $employee): View
    {
        return view('employees.show')
            ->with('employee', $employee);
    }
}
