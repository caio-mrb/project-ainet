<div class="w-full flex justify-items-center justify-center mt-4 {{ $attributes }}">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-center items-center" >
    @foreach($movies as $movie)
        <x-movies.card :movie="$movie"></x-movies>
    @endforeach
</div>
</div>
