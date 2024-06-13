@extends('layouts.main')

@section('main')
    <form action="{{ route('cart.add', ['screening' => $screening]) }}" method="POST" class="flex overflow-x-auto  flex-col space-y-2">
        @csrf
        <input type="hidden" name="screening_id" value="{{ json_encode($screening->id) }}">
        @foreach(collect($seatAvailability)->groupBy('seat.row') as $row => $seatsInRow)
        <div class="flex flex-row items-center">
        <div class="flex h-full">
            <span class="font-bold text-xl h-min">{{$seatsInRow[0]['seat']->row}}</span>
        </div>
            <div class="flex justify-center space-x-2 w-full">
                @foreach($seatsInRow as $seatInfo)
                    
                    <x-theaters.seat :seatInfo="$seatInfo"/>
                @endforeach
            </div>
        </div>
        @endforeach
        <div class="p-5 w-full uppercase text-center font-bold bg-gray-500 text-gray-200">Ecrã</div>
        <div class="flex justify-end">   
            <x-button element="a" type="light" text="Voltar" class="uppercase ms-4"
                href="{{ route('movies.show', ['movie' => $screening->movie]) }}"/> 
            <x-button element="submit" type="secondary" text="Confirmar" class="uppercase"/>
        </div>
    </form>
@endsection
