<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerController extends \Illuminate\Routing\Controller
{

    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Customer::class);
    }

    public function edit(Customer $customer): View
    {
        return view('customers.edit')
            ->with('customer', $customer);
    }

    
    public function index(Request $request){
        $users = User::paginate(20);

        return view('customers.index')
            ->with('users', $users);
    }
}
