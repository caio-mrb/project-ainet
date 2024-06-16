

    <div class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden
                    shadow sm:rounded-lg text-gray-900 dark:text-gray-50">
        <div class="max-full">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Dados da Compra
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 mb-6">
                        Clique em "Salvar" para prosseguir para o pagamento.
                    </p>
                </header>
                <form method="POST" action="{{ route('purchases.store') }}">
                    @csrf
                    <div class="mt-6 space-y-4">
                            @php
                                $user = Auth::user();
                            @endphp
                            @include('purchases.shared.fields', ['mode' => 'edit'])
                    </div>
                    <div class="flex justify-end mt-6">
                        <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                        </div>
                        <x-button element="submit" type="dark" text="Confirm & Pay" class="uppercase" />
                    </div>
                </form>
            </section>
        </div>
    </div>
