<style>
    .flipped {
        transform: rotateY(-180deg);
    }
</style>
<div x-data="{ flipped: false }" style="perspective: 1000px;" class="invisible md:visible flip-container w-64 h-[379px] relative" @mouseenter="flipped = true" @mouseleave="flipped = false">
    <div :class="{'flipped': flipped}" style="transition: transform 0.6s;transform-style: preserve-3d;" class="flip-inner w-full h-full relative">
        <div style="backface-visibility: hidden;" class="absolute top-0 left-0 w-full h-full text-white flex items-center justify-center rounded-lg">
            <img src="
        @if($movie->poster_filename)
            {{ asset('storage/posters/' . $movie->poster_filename) }}
        @else
            {{ asset('storage/posters/_no_poster_1.png') }}
        @endif
        " alt="{{ $movie->title }}">
        </div>
        <div style="backface-visibility: hidden;transform: rotateY(-180deg);" class="absolute p-3 top-0 left-0 w-full h-full bg-gray-200 text-white flex flex-col  rounded-lg">
            <div class="text-xl uppercase text-primary-red font-bold">{{ $movie->title }}, {{ $movie->year }}</div>
            
            <div class="text-md text-slate-700"><span class="font-semibold">Gênero:</span> {{ $movie->genres->name }}</div>
            <div class="text-md text-slate-700"><span class="font-semibold">Sinopse:</span> {{ $movie->synopsis }}</div>
            <div class="text-md text-slate-700 h-full"></div>
            <div class="text-xl uppercase text-primary-red font-bold w-full"><x-button element="a" type="rounded-primary" text="Ver mais" class="uppercase w-96"
                href="{{ route('movies.show', ['movie' => $movie]) }}"/></div>
        </div>
    </div>
</div>