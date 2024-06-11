@extends('layouts.main')

@section('main')
<div class="filter-card">
    <form method="GET" action="{{ route('home') }}">
        <div>
            <x-input-label for="genre" :value="__('Gênero')" />
            <select name="genre" id="genre" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-gray dark:focus:border-indigo-600 focus:ring-secondary-gray dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="" selected disabled>Selelecione um gênero</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->code}}"> {{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="search" required />
        </div>
    
    
        <div class="flex items-center justify-end mt-4">    
            <x-button
                            element="submit"
                            text="Buscar"
                            type="secondary"/>
        </div>
    </form>
</div>

    <x-movies.table :movies="$movies" :showView="true" :showEdit="true" :showDelete="true"/>
@endsection

