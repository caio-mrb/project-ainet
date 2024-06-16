@extends('layouts.main')

@section('header-title', 'Filmes ' . ($route == 'home' ? 'em Exibição' : ''))

@section('main')
<div class="filter-card p-4 rounded-md shadow">
    <x-movies.filter-card :filterAction="route($route)" :resetUrl="route($route)" :genres="$genres->pluck('name', 'code')->toArray()" :name="old('name', $filterByName)" :genre="old('year', $filterByGenre)" />
</div>
@if($route == 'home')
<div class="w-full flex justify-items-center justify-center mt-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-center items-center">
        @foreach($movies as $movie)
        <x-movies.card :movie="$movie"></x-movies>
            @endforeach
    </div>
</div>
@endif
@if($route == 'movie.index')
{{ $movies = Movies::all()}}

@endif

<div class="p-6">
    {{ $movies->links() }}
</div>

@endsection