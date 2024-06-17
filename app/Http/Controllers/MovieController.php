<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\View\View;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\MovieFormRequest;


class MovieController extends Controller
{
    public function index(Request $request)
    {
        $filterByGenre = $request->query('genre');
        $filterByName = $request->query('name');
        $filterByOnShow = $request->is('/');
        $route = 'movies.index';

        $genres = Genre::all();
        $moviesQuery = Movie::query();

        $todayDate = Carbon::today();
        $twoWeeksLater = Carbon::today()->addWeeks(2);

        if ($filterByGenre) {
            $moviesQuery->where('genre_code', $filterByGenre);
        }

        if ($filterByName) {
            $moviesQuery->where(function ($query) use ($filterByName) {
                $query->where('title', 'like', '%' . $filterByName . '%')
                    ->orWhere('synopsis', 'like', '%' . $filterByName . '%');
            });
        }

        if ($filterByOnShow) {
            $moviesQuery->whereHas('screenings', function ($query) use ($todayDate, $twoWeeksLater) {
                $query->whereBetween('date', [$todayDate, $twoWeeksLater]);
            });
            $route = 'home';
        }


        $movies = $moviesQuery
            ->orderBy('title')
            ->orderBy('year')
            ->paginate(8)
            ->withQueryString();

        return view('movies.index')
            ->with('route', $route)
            ->with('genres', $genres)
            ->with('movies', $movies)
            ->with('filterByGenre', $filterByGenre)
            ->with('filterByName', $filterByName);
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

    public function delete(Movie $movie)
    {
        $movie->delete();

        return back()
            ->with('alert-type', 'warning')
            ->with('alert-msg', 'Apagado com sucesso!');
    }

    public function edit(Movie $movie): View
    {
        return view('movies.edit')
            ->with('movie', $movie);
    }

    public function update(MovieFormRequest $request, Movie $movie)
    {
        if (!$movie) {
            return back()
                ->with('alert-type', 'warning')
                ->with('alert-msg', 'Erro ao editar filme!');
        }
        
        $validatedData = $request->validated();

        $movie->update($validatedData);

        $movie->save();

        return redirect()->route('movies.show', ['movie' => $movie])
            ->with('alert-type', 'warning')
            ->with('alert-msg', 'Filme editado com sucesso!');
    }
}
