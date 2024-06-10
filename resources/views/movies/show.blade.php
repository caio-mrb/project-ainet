@extends('layouts.main')

@section('main')
    <x-movies.card :movie="$movie" />
@endsection
