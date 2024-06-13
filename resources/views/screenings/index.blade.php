@extends('layouts.main')

@section('main')
<form action="#" class="flex flex-wrap flex-row">
    @foreach($seatAvailability as $seatInfo)
        
        <x-theaters.seat :seatInfo='$seatInfo'/>
    @endforeach

    <x-button element="submit" type="secondary" text="Confirmar" class="uppercase"/>
</form>
@endsection