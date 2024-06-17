@extends('layouts.main')
@section('main')

<div class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden
                    shadow sm:rounded-lg text-gray-900 dark:text-gray-50">
    <div class="max-full">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Editar informações do filme
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Clique em "Salvar" para guardar edição.
                </p>
            </header>
            <form method="POST" action="{{ route('movies.update', ['movie' => $movie])}}">
                @csrf
                @method('PUT')
                <div class="mt-6 space-y-4">
                    @include('movies.shared.fields', ['mode' => 'edit'])
                </div>
                <div class="flex justify-end mt-6">
                    <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                    </div>
                    <x-button element="submit" type="dark" text="Save edit" class="uppercase" />
                </div>
            </form>
        </section>
    </div>
</div>
@endsection