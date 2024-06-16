@extends('layouts.main')

@section('header-title', 'Carrinho')

@section('main')
<div class="flex flex-col lg:flex-row gap-6 w-full justify-center" >


    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden
                    shadow sm:rounded-lg text-gray-900 dark:text-gray-50">
            @empty($cart)
                <h3 class="text-xl w-96 text-center">Cart is Empty</h3>
            @else
            <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                <x-cart.table class='overflow-y-auto h-[500px]' :cart="$cart" :configuration="$configuration"></x-cart>
            </div>
            <div class="mt-2">
                <div class="flex justify-start space-x-12 items-end">
                    <div>
                        <form action="{{ route('cart.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button element="submit" type="danger" text="Limpar Carrinho" class="mt-4"/>
                        </form>
                    </div>
                </div>
            </div>
            @endempty
        </div>
    </div>

    @include('purchases.create')
</div>
@endsection
