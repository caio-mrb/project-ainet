@extends('layouts.main')

@section('header-title', 'Carrinho')

@section('main')
    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden
                    shadow sm:rounded-lg text-gray-900 dark:text-gray-50">
            @empty($cart)
                <h3 class="text-xl w-96 text-center">Cart is Empty</h3>
            @else
            <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                <x-screenings.table :cart="$cart" :configuration="$configuration"></x-screening>
            </div>
            <div class="mt-2">
                <div class="flex justify-between space-x-12 items-end">
                    <div>
                        <form action="{{ route('cart.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button element="submit" type="danger" text="Limpar Carrinho" class="mt-4"/>
                        </form>
                    </div>
                    <div>
                        <form action="{{ route('cart.confirm') }}" method="post">
                            @csrf
                                <x-button element="submit" type="dark" text="Confirmar" class="mt-4"/>
                        </form>
                    </div>
                </div>
            </div>
            @endempty
        </div>
    </div>
@endsection
