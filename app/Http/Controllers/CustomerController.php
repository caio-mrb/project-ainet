<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerController extends Controller
{

    //use AuthorizesRequests;

    /*public function __construct()
    {
        $this->authorizeResource(Customer::class);
    }*/

    public function show(User $user): View
    {
        return view('customers.show')
            ->with('user', $user);
    }

    
    public function index(Request $request){
        $users = User::paginate(20);

        return view('customers.index')
            ->with('users', $users);
    }
}
