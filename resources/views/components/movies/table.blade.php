<div {{ $attributes }}>
    <table class="table-auto border-collapse w-full">
        <thead>
            <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
                <th class="px-2 py-2 text-left">Filme</th>
                <th class="px-2 py-2 text-center">Gênero</th>
                <th class="px-2 py-2 text-center">Ano</th>
                <th class="px-2 py-2 text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-2 text-left hidden sm:table-cell">{{ $movie->title }}</td>
                <td class="px-2 py-2 text-center">{{ $movie->genres->name }}</td>
                <td class="px-2 py-2 text-center">{{ $movie->year }}</td>
                <td class="flex justify-center space-x-1">
                        <x-table.icon-show class="ps-3 px-0.5" href="{{ route('movies.show', ['movie' => $movie]) }}" />
                        <x-table.icon-edit class="px-0.5" href="{{ route('movies.edit', ['movie' => $movie]) }}" />
                        <x-table.icon-delete class="px-0.5" action="{{ route('movies.delete', ['movie' => $movie]) }}" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>