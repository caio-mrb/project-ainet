@extends('layouts.main')

@section('main')
    <x-movies.card :movies="$movie" />
@endsection
