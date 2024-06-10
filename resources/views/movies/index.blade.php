@extends('layouts.main')

@section('main')
<x-movies.table :movies="$movies" :showView="true" :showEdit="true" :showDelete="true"/>
@endsection

