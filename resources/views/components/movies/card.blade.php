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
        <div class="flex flex-row">
            <p>Filter:</p>
            <x-menus.submenu
            selectable="0"
            uniqueName="submenu_filter"
            >
            <x-slot:content>
                <div class="text-black ps-1 sm:max-w-[calc(100vw-39rem)] md:max-w-[calc(100vw-41rem)] lg:max-w-[calc(100vw-46rem)] xl:max-w-[34rem] truncate">
                    Teste
                </div>
            </x-slot>
        </x-menus.submenu>
        </div>

        @foreach($movie->screenings->unique('theater_id') as $screening)
            <p><strong>Theater:</strong> <a href="#">{{ $screening->theater->name }}</a></p>
        @endforeach

        @foreach($movie->screenings as $screening)
        <p><strong>session:</strong> <a href="#">{{ $screening->date }}</a> <a href="#">{{ $screening->start_time }}</a></p>
        @endforeach
    </div>
    
</div>
