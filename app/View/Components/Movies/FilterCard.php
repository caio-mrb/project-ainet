<?php

namespace App\View\Components\Movies;

use Closure;
use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class FilterCard extends Component
{
    public array $listGenres;

    public function __construct(
        public array $genres,
        public string $filterAction,
        public string $resetUrl,
        public ?string $name = null,
        public ?string $genre = null,
    )
    {
        $this->listGenres = (array_merge([null => 'Qualquer gênero'], $genres));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.movies.filter-card');
    }
}
