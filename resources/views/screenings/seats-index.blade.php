@extends('layouts.main')

@section('header-title')
<div class="w-full flex place-content-between">
    <p>Cinema: {{$screening->theater->name}} </p>
    <p>Filme: {{$screening->movie->title}}</p>
    <p>Sessão: {{\Carbon\Carbon::parse($screening->date)->format('d/m/y')}} - {{ \Carbon\Carbon::parse($screening->start_time)->format('H:i') }}</p>
</div>
@endsection

@section('main')
<div></div>
    <form action="{{ route('cart.add', ['screening' => $screening]) }}" method="POST" class="flex flex-col space-y-2">
        @csrf
        <input type="hidden" name="screening_id" value="{{ json_encode($screening->id) }}">
        <div class="flex justify-center w-full relative">
            <div class="absolute left-0 top-9 bottom-0 flex flex-col">
                @foreach(collect($seatAvailability)->groupBy('seat.row') as $row => $seatsInRow)
                    <div class="flex items-center w-full h-full">
                        <span class="font-bold text-center text-xl h-full">{{$seatsInRow[0]['seat']->row}}</span>
                    </div>
                @endforeach
            </div>
            <div class="overflow-x-auto overflow-y-hidden h-full w-fit ml-5">
                @foreach(collect($seatAvailability)->groupBy('seat.row') as $row => $seatsInRow)
                    <div class="flex flex-row gap-2 h-full">
                        <div class="flex space-x-2">
                            @foreach($seatsInRow as $seatInfo)
                                <div class="flex flex-col text-center">
                                    @if($seatsInRow[0]['seat']->row === "A")
                                        <span class="font-bold text-xl w-full">{{$seatInfo['seat']->seat_number}}</span>
                                    @endif
                                    <x-theaters.seat :seatInfo="$seatInfo"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="p-5 w-full uppercase text-center font-bold bg-gray-500 text-gray-200">Ecrã</div>
        <div class="flex justify-end gap-2">   
            <x-button element="a" type="light" text="Voltar" class="uppercase ms-4"
                href="{{ route('movies.show', ['movie' => $screening->movie]) }}"/> 
            <x-button element="submit" type="secondary" text="Confirmar" class="uppercase"/>
        </div>
    </form>
@endsection
