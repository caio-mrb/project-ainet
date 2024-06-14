<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\View\View;


class PurchaseController extends Controller
{
    public function store(Request $request){

        $newPurchase = Purchase::create($request->validated());
        $url = route('purchase.show', ['purchase' => $newPurchase]);
        $htmlMessage = "Purchase <a href='$url'><u>{$newPurchase->name}</u></a> ({$newPurchase->abbreviation}) has been made successfully!";
        return redirect()->route('home')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);

    }   

    public function create(): View
    {
        $newPurchase = new Purchase();
        return view('purchase.create')->with('purchase', $newPurchase);
    }
}
