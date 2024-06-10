@extends('layouts.main')

@section('main')
    <x-courses.table :movies="$movies" :showView="true" :showEdit="true" :showDelete="false"/>
@endsection

