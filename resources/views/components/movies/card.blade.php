<!-- resources/views/components/movies/card.blade.php -->
<div class="movie-card flex flex-row">
    
    <div class="movie-poster-container w-auto">
        <img src="
        @if($movie->poster_filename)
            {{ asset('storage/posters/' . $movie->poster_filename) }}
        @else
            {{ asset('storage/posters/_no_poster_1.png') }}
        @endif
        " alt="{{ $movie->title }}">
    </div>
    <div class="flex flex-col">
        <h2>{{ $movie->title }}</h2>
        <p><strong>Genre Code:</strong> {{ $movie->genre_code }}</p>
        <p><strong>Year:</strong> {{ $movie->year }}</p>
        <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
        <p><strong>Trailer:</strong> <a href="{{ $movie->trailer_url }}">{{ $movie->trailer_url }}</a></p>
    </div>
    
</div>
