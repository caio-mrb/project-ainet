<div {{ $attributes }}>
    <div class="relative">
        <div class="absolute inset-0 z-10">
            <table class="table-auto border-collapse w-full">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500">
                        <th class="px-2 py-2 text-left">Cinema</th>
                        <th class="px-2 py-2 text-left">Filme</th>
                        <th class="px-2 py-2 text-left">Data</th>
                        <th class="px-2 py-2 text-left">Horário</th>
                        <th class="px-2 py-2 text-left">Assento</th>
                        <th class="px-2 py-2 text-left">Preço</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="overflow-y-auto z-20 h-[450px] pt-12">
            <table class="table-auto border-collapse w-full">
                <tbody>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($cart as $cartItem)
                        <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                            <td class="px-2 py-2 text-left hidden sm:table-cell">{{ $cartItem['screening']->theater->name }}</td>
                            <td class="px-2 py-2 text-left">{{ $cartItem['screening']->movie->title }}</td>
                            <td class="px-2 py-2 text-left">{{ \Carbon\Carbon::parse($cartItem['screening']['date'])->format('d/m/y')}}</td>
                            <td class="px-2 py-2 text-center">{{ \Carbon\Carbon::parse($cartItem['screening']['start_time'])->format('H:i') }}</td>
                            <td class="px-2 py-2 text-center">{{ $cartItem['seat']['row'] }} - {{ $cartItem['seat']['seat_number'] }}</td>
                            <td class="px-2 py-2 text-left">{{ "€" . $ticketPrice = (Auth::check() ? number_format((float) $configuration['0']->ticket_price - (float) $configuration['0']->registered_customer_ticket_discount, 2) : $configuration['0']->ticket_price)  }}</td>
                            <td>
                                <x-table.icon-minus class="px-0.5"
                                    method="delete"
                                    action="{{ route('cart.remove', ['screening' => $cartItem['screening'], 'seat' => $cartItem['seat']]) }}"/>
                            </td>
                        </tr>
                        @php
                            $totalPrice += $ticketPrice;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                        <td colspan="5" class="text-right font-bold">Total: </td>
                        <td class="text-left font-bold">{{  " €" . number_format($totalPrice,2)}}</td>
                        {{ session()->put('total_price', $totalPrice) }}
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
