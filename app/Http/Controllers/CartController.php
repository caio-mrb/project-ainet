<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests\CartConfirmationFormRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Screening;
use App\Models\Purchase;
use App\Models\Seat;
use App\Models\Configuration;

class CartController extends Controller
{
    public function show(): View
    {
        $configuration = Configuration::all();

        $cart = session('cart', null);
        return view('cart.show')
            ->with('cart', $cart)
            ->with('configuration', $configuration);
    }

    public function addToCart(Request $request): RedirectResponse
    {

        $screening = Screening::find($request->input('screening_id'));

        if (!$screening) {
            return back()->with('alert-msg', 'Sessão não encontrada!')->with('alert-type', 'danger');
        }

        $screeningDatePlusFiveMin = Carbon::parse($screening->date . ' ' . $screening->start_time)->addMinutes(5) ;

        if($screeningDatePlusFiveMin->lt(Carbon::now()) ){
            return back()->with('alert-msg', 'Esta sessão está indisponível!')->with('alert-type', 'danger');
        }

        $selectedSeats = $request->input('seats', []);

        foreach ($selectedSeats as $seatId => $value) {
            $seat = Seat::find($seatId);
            if ($seat && filter_var($value, FILTER_VALIDATE_BOOLEAN)) {

                $cartItem = collect([
                    'seat' => $seat,
                    'screening' => $screening
                ]);
 
                $cart = session('cart', collect());
                $cart->push($cartItem);
                $request->session()->put('cart', $cart);
            }
        }

        $alertType = 'success';
        $htmlMessage = "Os assentos selecionados foram adicionados com sucesso.";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request, Screening $screening, Seat $seat): RedirectResponse
    {
        $cart = session('cart', null);
        if (!$cart) {
            $alertType = 'warning';
            $htmlMessage = "Assento <strong>\"{$seat->row} - {$seat->seat_number}\"</strong> da sessão <strong>\"{$screening->movie->title} - {$screening->date} {$screening->start_time}\"</strong> não foi removido do carrinho pois o carrinho está vazio!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        } else {
            $element = $cart->where('seat.id', $seat->id)
                ->where('screening.id', $screening->id)
                ->first();
            if ($element) {
                $cart->forget($cart->search($element));
                if ($cart->count() == 0) {
                    $request->session()->forget('cart');
                }
                $alertType = 'success';
                $htmlMessage = "Assento <strong>\"{$seat->row} - {$seat->seat_number}\"</strong> da sessão <strong>\"{$screening->movie->title} - {$screening->date} {$screening->start_time}\"</strong> foi removido do carrinho.";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            } else {
                $alertType = 'warning';
                $htmlMessage = "Assento <strong>\"{$seat->row} - {$seat->seat_number}\"</strong> da sessão <strong>\"{$screening->movie->title} - {$screening->date} {$screening->start_time}\"</strong> não foi removido pois o carrinho não possuia este assento";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            }
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', 'Shopping Cart has been cleared');
    }


    public function confirm(CartConfirmationFormRequest $request)
    {
        $cart = session('cart', null);
        if (!$cart || ($cart->count() == 0)) {
            return back()
                ->with('alert-type', 'danger')
                ->with('alert-msg', "Cart was not confirmed, because cart is empty!");
        }
        if(Auth::check()){
            $user = Auth::user();
            return view('purchase.create')->with('user', $user); 
        }
        return view('purchase.create')->with('user', null);
    }
}