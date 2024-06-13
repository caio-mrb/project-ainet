<!-- resources/views/components/movies/card.blade.php -->
<div class="movie-card flex flex-col md:flex-row">
    
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
        <p><strong>Gênero:</strong> {{ $movie->genres->name }}</p>
        <p><strong>Ano:</strong> {{ $movie->year }}</p>
        <p><strong>Sinopse:</strong> {{ $movie->synopsis }}</p>
        <p><strong>Trailer:</strong></p>
        @if($movie->trailer_url)
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{(strpos($movie->trailer_url, '&') !== false ? explode('=', explode('&', $movie->trailer_url)[0])[1] : explode('=', $movie->trailer_url)[1])}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        @else
            <p>Trailer indisponível</p>
        @endif
        <p><strong>Sessões:</strong></p>
        <div>
            @foreach($movie->screenings->groupBy('theater_id') as $screeningsByTheater)
                <div class="w-full bg-primary-red text-gray-200 font-bold">
                    <p>Cinema: {{ $screeningsByTheater->first()->theater->name }}</p>
                </div>
                <div class="flex flex-col overflow-auto h-32">
                    @foreach($screeningsByTheater->groupBy('date') as $date => $screeningsByDate)
                        <div class="flex flex-row content-center">
                            <div class="flex flex-col text-center text-gray-200 bg-gray-500 p-2">
                                <p class="text-sm font-bold">{{ \Carbon\Carbon::parse($date)->format('d') }}</p>
                                <p class="text-xs">{{ \Carbon\Carbon::parse($date)->format('M y') }}</p>
                            </div>

                            @foreach($screeningsByDate as $screening)
                                <x-button class="self-center ms-2" type="rounded-primary" text="{{ \Carbon\Carbon::parse($screening->start_time)->format('H:i') }}" 
                                    href="{{ route('screening.index', ['screening' => $screening]) }}"/>
                            @endforeach
                        </div>
                        <hr>
                    @endforeach
                </div>
            @endforeach
    </div>
    
</div>
