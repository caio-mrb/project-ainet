@extends('layouts.main')
@section('header-title','Minhas Compras')
@section('main')

<div class="flex flex-col">
@foreach($purchases as $purchase)
    <div>{{$purchase->date}} <a href="{{route('purchases.show', ['purchase' => $purchase])}}"><u>{{$purchase->id}}</u></a> €{{$purchase->total_price}} </div>
@endforeach
</div>

@endsection

