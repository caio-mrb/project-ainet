<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function store(Request $request){

        $user = Auth::check() ? Auth::user() : null;

        $validatedData = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|string',
            'nif' => 'nullable|string',
            'payment_ref' => 'required|string',
            'payment_type' => 'required|in:PAYPAL,MBWAY,VISA'
        ]);

        // Obter dados da sessão
        $sessionData = [
            'customer_id' => $user->id,
            'date' => Carbon::today(),
            'total_price' => Session::get('total_price'),
            'receipt_pdf_filename' => null
        ];
    
        // Combinar dados validados com dados da sessão
        $combinedData = array_merge($validatedData, $sessionData);
        // Criar a nova compra
        $newPurchase = Purchase::create($combinedData);
        $url = route('purchase.show', ['purchase' => $newPurchase]);
        $htmlMessage = "Purchase <a href='$url'><u>{$newPurchase->name}</u></a> ({$newPurchase->abbreviation}) has been made successfully!";
        return redirect()->route('home')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }   

    public function create(): View
    {
        $cart = session('cart', null);
        return view('purchase.create')
            ->with('cart', $cart);
    }
}
