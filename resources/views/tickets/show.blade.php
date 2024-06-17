@extends('layouts.main')
@section('header-title','Bilhete #' . $ticket->id)
@section('main')

    <div><strong>Filme:</strong> {{$ticket->screening->movie->title}} <strong>Data:</strong> {{$ticket->screening->date}} {{$ticket->screening->start_time}} <strong>Assento:</strong> {{$ticket->seat->row}} - {{$ticket->seat->seat_number}} <strong>Preço:</strong> {{$ticket->price}} <strong>Estado:</strong> {{$ticket->status}}</div>

    <div>{{ $qrCode }}</div>
@endsection