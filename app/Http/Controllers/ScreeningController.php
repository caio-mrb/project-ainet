<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Screening;
use Illuminate\Http\Request;



class ScreeningController extends Controller
{
    public function seatsIndex(Screening $screening){
        $seats = Seat::where('theater_id', $screening->theater_id)->get();

        $cart = session('cart', collect());

        $seatAvailability = [];
        
        foreach ($seats as $seat) {
            $isInCart = $cart->contains(function ($item) use ($seat, $screening) {
                return $item['seat']['id'] === $seat->id && $item['screening']['id'] === $screening->id;
            });

            if ($isInCart) {
                $isFree = false;
            } else {
                $ticket = Ticket::where('screening_id', $screening->id)
                                ->where('seat_id', $seat->id)
                                ->first();
    
                $isFree = $ticket ? false : true;
            }

            $seatAvailability[] = [
                'seat' => $seat,
                'isFree' => $isFree,
            ];
        }
        
        return view('screenings.seats-index')
            ->with('seatAvailability',$seatAvailability)
            ->with('screening',$screening);
    } 
    
    public function index(Request $request){
        return view('screenings.index');
    }
}
