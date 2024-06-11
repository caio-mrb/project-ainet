@extends('layouts.main')

@section('main')
<main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        
        <x-movies.card :movie="$movie" />
    </div>
</main>
@endsection
