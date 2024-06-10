<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function index(Request $request)
    {
        if (isset($queryParameters['title'])) {
            // Se existir, filtra os resultados pelo título
            $filteredResults = Movie::where('titulo', $queryParameters['title'])->get();
        } else {
            // Se não existir, obtém os primeiros 10 resultados
            $filteredResults = Movie::
        }

        $filterByTitle =  Movie::take(10)->get();
        $filterByYear = $request->query('year','2024');
        $filterBySemester = $request->input('semester') ?? 1;
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
