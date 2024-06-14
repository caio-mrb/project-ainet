<div class="transition ease-in-out relative h-80 w-60 bg-lime-200 ">
    <div class="absolute h-full w-full bg-lime-200">

    </div>
    
</div>
<style>
    .flipped {
        transform: rotateY(-180deg);
    }
</style>
<div x-data="{ flipped: false }" style="perspective: 1000px;" class="invisible md:visible flip-container w-64 h-64 relative" @mouseenter="flipped = true" @mouseleave="flipped = false">
    <div :class="{'flipped': flipped}" style="transition: transform 0.6s;transform-style: preserve-3d;" class="flip-inner w-full h-full relative">
        <div style="backface-visibility: hidden;" class="absolute top-0 left-0 w-full h-full flip-front bg-blue-500 text-white flex items-center justify-center rounded-lg">
            <img src="
        @if($movie->poster_filename)
            {{ asset('storage/posters/' . $movie->poster_filename) }}
        @else
            {{ asset('storage/posters/_no_poster_1.png') }}
        @endif
        " alt="{{ $movie->title }}">
        </div>
        <!-- Back Side -->
        <div style="backface-visibility: hidden;transform: rotateY(-180deg);" class="absolute top-0 left-0 w-full h-full bg-green-500 text-white flex items-center justify-center rounded-lg">
            <h2 class="text-2xl font-bold">Back Side</h2>
        </div>
    </div>
</div>