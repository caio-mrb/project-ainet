<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Screening;
use Illuminate\Http\Request;


class ScreeningController extends Controller
{
    public function index(Screening $screening)
    {    
        $seats = Seat::where('theater_id', $screening->theater_id)->get();

        $seatAvailability = [];
        
        foreach ($seats as $seat) {
            $ticket = Ticket::where('screening_id', $screening->id)
                            ->where('seat_id', $seat->id)
                            ->first();

            $isFree = $ticket ? false : true;

            $seatAvailability[] = [
                'seat' => $seat,
                'isFree' => $isFree,
            ];
        }
        
        return view('screenings.index')
            ->with('seatAvailability',$seatAvailability);
    }  
}
