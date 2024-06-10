<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function index()
    {
        // Retrieve all movies
        $movies = Movie::all();

        // Pass the movies to the view
        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        // Retrieve a single movie by its ID
        $movie = Movie::findOrFail($id);

        // Pass the movie to the view
        return view('movies.show', compact('movie'));
    }
}
