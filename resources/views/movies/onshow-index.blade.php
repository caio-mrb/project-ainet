@extends('layouts.main')

@section('header-title', 'Filmes em Exibição')

@section('main')
<div class="filter-card p-4 rounded-md shadow">
    <form method="GET" action="{{ route('home') }}">
        <div class="flex flex-row w-full gap-6">
            <div class="w-full">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block w-full" type="text" name="search" value="{{$request->query('search') ?? '' }}" />
            </div>
            <div class="justify-self-end">
                <x-input-label for="genre" :value="__('Gênero')" />
                <select name="genre" id="genre" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-gray dark:focus:border-indigo-600 focus:ring-secondary-gray dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="" selected disabled>Selelecione um gênero</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->code}}" {{$genre->code === $request->query('genre') ? 'selected' : ''}}> {{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="flex items-center gap-2 justify-end mt-4">    
            <x-button element="a" type="light" text="Cancel" :href="route('home')"/>
            <x-button
                            element="submit"
                            text="Buscar"
                            type="secondary"/>
        </div>
    </form>
</div>
<div class="w-full flex justify-items-center justify-center mt-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-center items-center" >
        @foreach($movies as $movie)
            <x-movies.card :movie="$movie"></x-movies>
        @endforeach
    </div>
</div>

{{ $movies->links() }}
@endsection

