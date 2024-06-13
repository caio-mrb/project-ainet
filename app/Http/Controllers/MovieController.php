<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Genre;

use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;


class MovieController extends Controller
{
    public function index(Request $request, Collection $genres)
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
    
        return view('movies.index')
        ->with('movies',$movies)
        ->with('genres',$genres)
        ->with('request',$request);
    }

    public function show(Movie $movie)
    {
        return view('movies.show')
            ->with('movie',$movie);
    }

}
