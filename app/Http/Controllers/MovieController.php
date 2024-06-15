<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Genre;

use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;


class MovieController extends Controller
{
    public function onShowIndex(Request $request, Collection $genres)
    {    
        $genres = Genre::all();

        $genre = $request->query('genre');
        $search = $request->query('search');

        $moviesQuery = Movie::query();
        
        $todayDate = Carbon::today();
        $twoWeeksLater = Carbon::today()->addWeeks(2);

        if ($genre) {
            $moviesQuery->where('genre_code', $genre);
        }

        if ($search) {
            $moviesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('synopsis', 'like', '%' . $search . '%');
            });
        }

        $moviesQuery->whereHas('screenings', function ($query) use ($todayDate, $twoWeeksLater) {
            $query->whereBetween('date', [$todayDate, $twoWeeksLater]);
        })->orderBy('title');
    
        
        $movies = $moviesQuery
            ->paginate(20);
    
        return view('movies.onshow-index')
        ->with('movies',$movies)
        ->with('genres',$genres)
        ->with('request',$request);
    }

    public function show(Movie $movie)
    {
        $screenings = $movie->screenings;
        $cart = session('cart', collect());
    
        foreach ($screenings as $screening) {
            $seats = Seat::where('theater_id', $screening->theater_id)->get();
            $isFull = true;
    
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
    
                if ($isFree) {
                    $isFull = false;
                    break;
                }
            }
            $screening->isFull = $isFull;
        }
    
        return view('movies.show')
            ->with('movie', $movie)
            ->with('screenings', $screenings);
    }

}
