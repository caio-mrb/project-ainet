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


        @foreach($movie->screenings->unique('theater_id') as $screening)
            <p><strong>Theater:</strong> <a href="#">{{ $screening->theater->name }}</a></p>
        @endforeach
        <div>
            <x-input-label for="screening" :value="__('Sessão')" />
            <select name="screening" id="screening" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-gray dark:focus:border-indigo-600 focus:ring-secondary-gray dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="" selected disabled>Sessões</option>
                @foreach($movie->screenings as $screening)
                    <option value=""> {{ $screening->date ." " . $screening->start_time }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
</div>
