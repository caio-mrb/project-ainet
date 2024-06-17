@extends('layouts.main')

@section('header-title', 'Usuários ')
@section('main')

<div class="filter-card p-4 rounded-md shadow">
    <x-users.filter-card :filterAction="route($route)" :resetUrl="route($route)" :name="old('name', $filterByName)"/>
</div>
<div class="w-full">
    <x-users.table :users="$users" class="w-full"></x-users>
</div>
<div class="p-6">
    {{ $users->links() }}
</div>

@endsection