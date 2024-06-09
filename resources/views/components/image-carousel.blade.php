<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{ asset('storage/posters/' . $images[0]) }}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('storage/posters/' . $images[1]) }}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('storage/posters/' . $images[2]) }}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<!---
<div class="carousel-container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($images as $index => $image)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : ''}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($images as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : ''}}">
                    <img class="d-block w-100" src="{{ asset('storage/posters/' . $image) }}" alt="Slide {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
</div>
-->

<!--  
<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <! -- Carousel wrapper -- >
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        @foreach ($images as $index => $image)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('storage/posters/' . $image) }}" class="block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Carousel Image {{ $index + 1 }}">
            </div>
        @endforeach
    </div>
    <! -- Slider indicators -- >
    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
        @foreach ($images as $index => $image)
            <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
        @endforeach
    </div>
    <! -- Slider controls -- >
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
-->


