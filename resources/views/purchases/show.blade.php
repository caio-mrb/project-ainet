@extends('layouts.main')
@section('header-title','Compra #' . $purchase->id)
@section('main')
    <h2>Bilhetes</h2>
    @foreach($purchase->tickets as $ticket)
        <div>Bilhete: <a href="{{route('tickets.show', ['ticket' => $ticket])}}"><u>{{$ticket->id}}</u></a></div>
    @endforeach
@endsection
