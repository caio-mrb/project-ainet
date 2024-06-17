@extends('layouts.main')
@section('header-title','Validar Bilhete #' . $ticket->id)
@section('main')

    <div><strong>Filme:</strong> {{$ticket->screening->movie->title}} <strong>Data:</strong> {{$ticket->screening->date}} {{$ticket->screening->start_time}} <strong>Assento:</strong> {{$ticket->seat->row}} - {{$ticket->seat->seat_number}} <strong>Preço:</strong> {{$ticket->price}} <strong>Estado:</strong> {{$ticket->status}}</div>
    <div><form method="POST" action="{{ route('tickets.validate', ['ticket'=>$ticket]) }}">
        @csrf
        <x-field.radiogroup required name="entrance" label="Entrada"
            :options="['Allowed' => 'Permitida', 'Denied' => 'Negada']"/>
        <div class="flex mt-6">
            <x-button element="submit" type="secondary" text="Confirmar" class="uppercase"/>
        </div>
    </form></div>
@endsection