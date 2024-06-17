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


    public function index(Request $request)
    {
        $filterByName = $request->query('name');
        $route = 'customers.index';

        $users = User::all();
        $userQuery = User::query();

        if ($filterByName) {
            $userQuery->where(function ($query) use ($filterByName) {
                $query->where('name', 'like', '%' . $filterByName . '%');
            });
        }


        $users = $userQuery
            ->orderBy('name')
            ->paginate(8)
            ->withQueryString();

        return view('customers.index')
            ->with('users', $users)
            ->with('route', $route)
            ->with('filterByName', $filterByName);
    }
}
