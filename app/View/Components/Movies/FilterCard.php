<?php

namespace App\View\Components\Movies;

use Closure;
use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterCard extends Component
{
    public function __construct(
        public object $movies,
        public object $genres,
        public object $years,
        public string $filterAction,
        public string $resetUrl,
        public ?string $movie = null,
        public ?string $genre = null,
        public ?int $year = null,
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.movies.filter-card');
    }
}
