<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function edit(User $employee): View
    {
        return view('employee.edit')
            ->with('employee', $employee);
    }
}
