<!-- resources/views/components/movies/card.blade.php -->
<div class="movie-card">
    <h2>{{ $movie->title }}</h2>
    <p><strong>Genre Code:</strong> {{ $movie->genre_code }}</p>
    <p><strong>Year:</strong> {{ $movie->year }}</p>
    <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
    <p><strong>Trailer:</strong> <a href="{{ $movie->trailer_url }}">{{ $movie->trailer_url }}</a></p>
    @if($movie->poster_filename)
        <img src="{{ asset('storage/posters/' . $movie->poster_filename) }}" alt="{{ $movie->title }}">
    @endif
</div>
