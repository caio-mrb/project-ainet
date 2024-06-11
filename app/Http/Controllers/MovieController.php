<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;


class MovieController extends Controller
{
    public function handle(Request $request)
    {
        
        $genres = Genre::all();

        $genre = $request->query('genre');
        $search = $request->query('search');

        if ($genre || $search) {
            return $this->search($request, $genres);
        } else {
            return $this->index($request, $genres);
        }
    }

    public function index(Request $request, Collection $genres)
    {        
        $date = "2022-01-02";

        $moviesQuery = Movie::whereHas('screenings', function ($query) use ($date) {
            $query->whereDate('date', $date);
        })->orderBy('year');
        
        $movies = $moviesQuery
            ->paginate(20);
    
        // Return the view with the movies
        return view('movies.index')
        ->with('movies',$movies)
        ->with('genres',$genres);
    }

    public function show(Movie $movie)
    {
        return view('movies.show',)
            ->with('movie',$movie);
    }

    public function search(Request $request, Collection $genres)
    {
        $genre = $request->query('genre');
        $search = $request->query('search');

        // Initialize the query builder for the Movie model
        $moviesQuery = Movie::query();


        // Apply the genre filter if a genre is provided
        if ($genre) {
            $moviesQuery->where('genre_code', $genre);
        }

        // Apply the search filter if a search string is provided
        if ($search) {
            $moviesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('synopsis', 'like', '%' . $search . '%');
            });
        }

        // Get the movies ordered by year
        $movies = $moviesQuery->orderBy('year')->paginate(20);
    

        // Return the view with the movies
        return view('movies.index')
            ->with('movies',$movies)
            ->with('genres',$genres);
    }

}
