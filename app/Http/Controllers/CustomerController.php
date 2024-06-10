<?php

namespace App\Http\Controllers;

use App\Http\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function edit(Customer $customer): View
    {
        return view('customer.edit')
            ->with('customer', $customer);
    }
}
