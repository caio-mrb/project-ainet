@if($selectable)
    @if($selected)
        <a class="px-3 py-4 border-b-2 border-transparent
                text-sm font-medium leading-5 inline-flex h-auto
                text-gray-700 dark:text-gray-300 underline decoration-primary-red
                dark:hover:bg-gray-800
                focus:outline-none
                focus:text-gray-700 dark:focus:text-gray-300
                focus:bg-gray-100 dark:focus:bg-gray-800"
            @if ($form)
                href="#"
                onclick="event.preventDefault();
                document.getElementById({{ $form }}).submit();"
            @else
                href="{{ $href }}"
            @endif>
            {{ $content }}
        </a>
    @else
        <a class="px-3 py-4 border-b-2 border-transparent
                text-sm font-medium leading-5 inline-flex h-auto
                text-gray-500 dark:text-gray-400 hover:underline hover:decoration-primary-red
                hover:text-gray-700 dark:hover:text-gray-300
                 dark:hover:bg-gray-800
                focus:outline-none
                focus:text-gray-700 dark:focus:text-gray-300
                focus:bg-gray-100 dark:focus:bg-gray-800"
            @if ($form)
                href="#"
                onclick="event.preventDefault();
                document.getElementById({{ $form }}).submit();"
            @else
                href="{{ $href }}"
            @endif>
            {{ $content }}
        </a>
    @endif
@else
    <a class="px-3 py-4 border-b-2 border-transparent
                text-sm font-medium leading-5 inline-flex h-auto
                text-gray-500 dark:text-gray-400 hover:underline hover:decoration-primary-red
                hover:text-gray-700 dark:hover:text-gray-300
                 dark:hover:bg-gray-800
                focus:outline-none
                focus:text-gray-700 dark:focus:text-gray-300
                focus:bg-gray-100 dark:focus:bg-gray-800"
            @if ($form)
                href="#"
                onclick="event.preventDefault();
                document.getElementById('{{ $form }}').submit();"
            @else
                href="{{ $href }}"
            @endif>
        {{ $content }}
    </a>
@endif
