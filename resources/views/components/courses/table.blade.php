@props(['movies', 'showView' => true, 'showEdit' => true, 'showDelete' => true])
<div {{ $attributes }}>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left hidden lg:table-cell">ID</th>
            <th class="px-2 py-2 text-left">Title</th>
            <th class="px-2 py-2 text-left">Genre</th>
            <th class="px-2 py-2 text-right hidden sm:table-cell">Year</th>
            <th class="px-2 py-2 text-right hidden sm:table-cell"></th>
            @if($showView)
                <th></th>
            @endif
            @if($showEdit)
                <th></th>
            @endif
            @if($showDelete)
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($movies as $movie)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $movie->id }}</td>
                <td class="px-2 py-2 text-left">{{ $movie->title }}</td>
                <td class="px-2 py-2 text-left">{{ $movie->genre_code }}</td>
                <td class="px-2 py-2 text-right hidden sm:table-cell">{{ $movie->year }}</td>
                <td class="px-2 py-2 text-right hidden sm:table-cell"><x-button element="a" type="light" text="Ver mais" class="uppercase ms-4"
                href="{{ route('movies.show', ['id' => $movie->id]) }}"/></td>  
                @if($showView)
                    @can('view', $movie)
                        <td>
                            <x-table.icon-show class="ps-3 px-0.5"
                            href="{{ route('courses.show', ['course' => $movie]) }}"/>
                        </td>
                    @else
                        <td></td>
                    @endcan
                @endif
                @if($showEdit)
                    @can('update', $movie)
                        <td>
                            <x-table.icon-edit class="px-0.5"
                            href="{{ route('courses.edit', ['course' => $movie]) }}"/>
                        </td>
                    @else
                        <td></td>
                    @endcan
                @endif
                @if($showDelete)
                    @can('delete', $movie)
                        <td>
                            <x-table.icon-delete class="px-0.5"
                            action="{{ route('courses.destroy', ['course' => $movie]) }}"/>
                        </td>
                    @else
                        <td></td>
                    @endcan
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
