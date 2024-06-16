<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseFormRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Configuration;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function store(PurchaseFormRequest $request): RedirectResponse
    {

        $user = Auth::user();

        $cart = session('cart', null);
        $configuration = Configuration::all();

        $ticket_price = $configuration['0']->ticket_price;
        $discount = $configuration['0']->registered_customer_ticket_discount;

        $validatedData = $request->validated();

        $sessionData = [
            'customer_id' => $user?->id,
            'date' => Carbon::today(),
            'total_price' => Session::get('total_price'),
            'receipt_pdf_filename' => null
        ];

        $combinedData = array_merge($validatedData, $sessionData);

        $newPurchase = Purchase::create($combinedData);
        foreach($cart as $cartItem)
        {
            $ticketData = [
                'screening_id' => $cartItem['screening']['id'],
                'seat_id' => $cartItem['seat']['id'],
                'purchase_id' => $newPurchase->id,
                'price' => ($user == null ?  $ticket_price : $ticket_price - $discount),
            ]; 

            Ticket::create($ticketData);
        }

        $request->session()->forget('cart');

        $url = route('purchase.show', ['purchase' => $newPurchase]);
        $htmlMessage = "Purchase <a href='$url'><u>{$newPurchase->id}</u></a> ({$newPurchase->id}) has been made successfully!";
        
        return redirect()->route('cart.show')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }   

    public function create(): View
    {
        $cart = session('cart', null);
        return view('purchase.create')
            ->with('cart', $cart);
    }

    
    public function show(): View
    {
        return view('purchase.show');
    }
}
