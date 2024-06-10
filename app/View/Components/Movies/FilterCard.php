<?php

namespace App\View\Components\Movies;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterCard extends Component
{
    public array $listTitle;
    public array $listGenre;
    public array $listYear;

    public function __construct(
        public array $movies,
        public string $filterAction,
        public string $resetUrl,
        public ?string $movie = null,
        public ?int $year = null,
        public ?int $genre_code = null,
        public ?string $title = null,
    )
    {
        $this->listCourses = (array_merge([null => 'Any course'], $movies));
        $this->listYears = [
            null => 'Any year',
            1 => '1st year',
            2 => '2nd year',
            3 => '3rd year'
        ];
        $this->listSemesters = [
            null => 'Any semester',
            1 => '1st semester',
            2 => '2nd semester',
            0 => 'Annual'
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.movies.filter-card');
    }
}
