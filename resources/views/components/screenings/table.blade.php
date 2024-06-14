<div {{ $attributes }}>
    <table class="table-auto border-collapse">
        <thead>
        <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
            <th class="px-2 py-2 text-left">Cinema</th>
            <th class="px-2 py-2 text-left">Filme</th>
            <th class="px-2 py-2 text-left">Data</th>
            <th class="px-2 py-2 text-left">Horário</th>
            <th class="px-2 py-2 text-left">Assento</th>
            <th class="px-2 py-2 text-left">Preço</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
                {{ $totalPrice = 0 }}
                {{var_dump(Auth::check())}}
        @foreach ($cart as $cartItem)
            @foreach ($configuration as $config)
                     {{ $ticketPrice = (Auth::check() ? number_format((float) $config->ticket_price - (float) $config->registered_customer_ticket_discount, 2) : $config->ticket_price) }}
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-2 text-left hidden sm:table-cell">{{ $cartItem['screening']->theater->name }}</td>
                <td class="px-2 py-2 text-left">{{ $cartItem['screening']->movie->title }}</td>
                <td class="px-2 py-2 text-left">{{ \Carbon\Carbon::parse($cartItem['screening']['date'])->format('d/m/y')}}</td>
                <td class="px-2 py-2 text-center">{{ \Carbon\Carbon::parse($cartItem['screening']['start_time'])->format('H:i') }}</td>
                <td class="px-2 py-2 text-center">{{ $cartItem['seat']['row'] }} - {{ $cartItem['seat']['seat_number'] }}</td>
                <td class="px-2 py-2 text-left">{{ "€" .  $ticketPrice  }}</td>
                <td>
                    <x-table.icon-minus class="px-0.5"
                        method="delete"
                        action="{{ route('cart.remove', ['screening' => $cartItem['screening'], 'seat' => $cartItem['seat']]) }}"/>
                </td>
            </tr>
                {{ $totalPrice += $ticketPrice}}
            @endforeach
        @endforeach
        </tbody>
        <tfoot>
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td colspan="5" class="text-right font-bold">Total: </td>
                <td class="text-left font-bold">{{  " €" . number_format($totalPrice,2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
