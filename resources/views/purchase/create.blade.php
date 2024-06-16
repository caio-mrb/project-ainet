@extends('layouts.main')
@section('header-title', 'New Course')
@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Receive Informations
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 mb-6">
                        Click on "Save" button to store the information.
                    </p>
                </header>
                <form method="POST" action="{{ route('purchase.store') }}">
                    @csrf
                    <div class="mt-6 space-y-4">
                        @if (Auth::check())
                        @include('purchase.shared.fields', ['mode' => 'show'])
                        @else
                        @include('purchase.shared.fields', ['mode' => 'create'])
                        @endif
                    </div>
                    <div class="flex mt-6">
                        <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                        </div>
                        <x-button element="submit" type="dark" text="Confirm & Pay" class="uppercase" />
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection