<div class="w-full flex justify-items-center justify-center {{ $attributes }}">
<div class="flex flex-row flex-wrap gap-4 md:w-full lg:w-3/4" >
    @foreach($movies as $movie)
        <x-movies.card :movie="$movie"></x-movies>
    @endforeach
</div>
</div>
