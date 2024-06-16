@extends('layouts.main')
@section('header-title', $movie->title)
@section('main')

<div class="movie-card w-full place-content-center flex flex-col md:flex-row">
    
    <div class="flex flex-col w-120 md:w-80 p-4">
        <img src="
        @if($movie->poster_filename)
            {{ asset('storage/posters/' . $movie->poster_filename) }}
        @else
            {{ asset('storage/posters/_no_poster_1.png') }}
        @endif
        " alt="{{ $movie->title }}">

        <p><strong>Título:</strong> {{ $movie->title }}</p>

        <div class="flex flex-row place-content-between w-full">
            <p><strong>Gênero:</strong> {{ $movie->genres->name }}</p>
            <p><strong>Ano:</strong> {{ $movie->year }}</p>
        </div>
        
        <p><strong>Sinopse:</strong> {{ $movie->synopsis }}</p>
    </div>
        
    <div class="flex flex-col w-120 p-4">
        @if($movie->trailer_url)
            <iframe class="rounded-md" width="560" height="315" src="https://www.youtube.com/embed/{{(strpos($movie->trailer_url, '&') !== false ? explode('=', explode('&', $movie->trailer_url)[0])[1] : explode('=', $movie->trailer_url)[1])}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        @else
            <p>Trailer indisponível</p>
        @endif
        <div class="mt-4">
            @foreach($screenings->groupBy('theater_id') as $screeningsByTheater)
                <div class="w-full bg-primary-red text-gray-200 font-bold p-2 rounded-t-md">
                    <p>Cinema: {{ $screeningsByTheater->first()->theater->name }}</p>
                </div>
                <div class="flex flex-col overflow-y-auto h-48 rounded-b-md">
                    @foreach($screeningsByTheater->groupBy('date') as $date => $screeningsByDate)
                        @if(Carbon\Carbon::parse($date)->lt(Carbon\Carbon::today()))
                            @continue
                        @endif
                        <div class="flex flex-row content-center">
                            <div class="flex flex-col text-center text-gray-200 bg-gray-500 px-2 py-1">
                                <p class="text-xs">{{ \Carbon\Carbon::parse($date)->format('D') }}</p>
                                <p class="text-sm font-bold">{{ \Carbon\Carbon::parse($date)->format('d') }}</p>
                                <p class="text-xs">{{ \Carbon\Carbon::parse($date)->format('M y') }}</p>
                            </div>
                            @foreach($screeningsByDate as $screening)
                            @if(Carbon\Carbon::parse($screening->date . ' ' .$screening->start_time)->addMinutes(5)->lt(Carbon\Carbon::now()))
                                @continue
                            @endif
                            
                            <div class="relative flex">
                            @if($isFull = $screening->isFull)
                                <div class="absolute h-min w-min p-1 left-3 top-1.5 font-bold text-xs text-gray-200 select-none rotate-12 z-20 uppercase">Esgotado</div>
                                <svg class="absolute left-1.5 bottom-0 rotate-12 fill-primary-red z-10" width="82" height="90" viewBox="0 0 407 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0H407L364 43.7671L407 90H0L43 45L0 0Z"/>
                                </svg>
                            @endif
                                <x-button class="self-center ms-2 z-0" type="{{$isFull = $screening->isFull ? 'rounded-secondary' : 'rounded-primary'}}" text="{{ \Carbon\Carbon::parse($screening->start_time)->format('H:i') }}" 
                                    href="{{$isFull = $screening->isFull ? '' :  route('screening.seats-index', ['screening' => $screening]) }}"/>
                            </div>
                            
                            @endforeach
                        </div>
                        <hr>
                        
                    @endforeach
                </div>
            @endforeach
        </div>
    
</div>
@endsection
