<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseFormRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Services\Payment;
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

        if(!$cart ){
            return back()
            ->with('alert-type', 'warning')
            ->with('alert-msg', 'O carrinho está vazio!');
        }

        $ticket_price = $configuration['0']->ticket_price;
        $discount = $configuration['0']->registered_customer_ticket_discount;

        $validatedData = $request->validated();

        $validPaymentMehod = match($validatedData['payment_type'])
        {
            'VISA' => Payment::payWithVisa(substr($validatedData['payment_ref'], 0, -3), substr($validatedData['payment_ref'], -3)),
            'PAYPAL' => Payment::payWithPaypal($validatedData['payment_ref']),
            'MBWAY' => Payment::payWithMbway($validatedData['payment_ref']),
            default => false,
        };

        if(!$validPaymentMehod){
            return back()
            ->with('alert-type', 'warning')
            ->with('alert-msg', 'Método de pagamento invalido!');
        }

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

        $url = route('purchases.show', ['purchase' => $newPurchase]);
        $htmlMessage = "Compra <a href='$url'><u>#{$newPurchase->id}</u></a> has been made successfully!";
        
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }   

    public function create(): View
    {
        $cart = session('cart', null);
        return view('purchases.create')
            ->with('cart', $cart);
    }

    
    public function show(Purchase $purchase): View
    {
        return view('purchases.show')
            ->with('purchase',$purchase);
    }

    public function index(): View
    {
        $purchases = collect();

        if(Auth::check()){
            $purchases = Purchase::where('customer_id', Auth::user()->id)->orderBy('date', 'desc')->get();
        }

        return view('purchases.index')
            ->with('purchases',$purchases);
    }
}
