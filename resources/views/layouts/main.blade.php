<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CineMagic</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts AND CSS Fileds -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-800">

        <!-- Navigation Menu -->
        <nav class="bg-primary-red dark:bg-gray-900 border-b-8 border-secondary-red dark:border-gray-800">
            <!-- Navigation Menu Full Container -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Logo + Menu Items + Hamburger -->
                <div class="relative flex flex-col sm:flex-row px-6 sm:px-0 grow justify-between">
                    <!-- Logo -->
                    <div class="shrink-0 -ms-4">
                        <a href="{{ route('home')}}">
                            <div class="flex align-center h-16 w-40 bg-cover dark:hidden">
                                <x-logo />
                            </div>
                        </a>
                    </div>

                    <!-- Menu Items -->
                    <div id="menu-container" class="grow flex flex-col sm:flex-row items-stretch
                    invisible h-0 sm:visible sm:h-auto">
                        <!-- Menu Item: Home -->
                        <x-menus.menu-item content="Home" href="{{ route('home') }}" selected="{{ Route::currentRouteName() == 'home'}}" />

                        <x-menus.menu-item content="Filmes" href="{{ route('movies.index') }}" selected="{{ Route::currentRouteName() == 'movies.index'}}" />

                        <x-menus.menu-item content="Cinemas" href="{{ route('theaters.index') }}" selected="{{ Route::currentRouteName() == 'theaters.index'}}" />
                        
                        <x-menus.menu-item content="Sessões" href="{{ route('screenings.index') }}" selected="{{ Route::currentRouteName() == 'screenings.index'}}" />

                        <x-menus.menu-item content="Bilhetes" href="{{ route('tickets.index') }}" selected="{{ Route::currentRouteName() == 'tickets.index'}}" />

                        <x-menus.menu-item content="Usuários" href="{{ route('customers.index') }}" selected="{{ Route::currentRouteName() == 'customers.index'}}" />

                        <x-menus.submenu selectable="0" uniqueName="submenu_others" content="More">
                            <x-menus.submenu-item content="Administratives" selectable="0" href="{{ route('administratives.index') }}" />
                            <hr>
                        </x-menus.submenu>

                        {{-- If user has any of the 4 menu options previlege, then it should show the submenu --}}
                        
                        <div class="grow"></div>

                        <!-- Menu Item: Cart -->
                        <x-menus.cart :href="route('cart.show')" selectable="1" selected="{{ Route::currentRouteName() == 'cart.show'}}" :total="session('cart') ? session('cart')->count() : 0" />


                        @auth
                        <x-menus.submenu selectable="0" uniqueName="submenu_user">
                            <x-slot:content>
                                <div class="pe-1">
                                    <img src="{{ Auth::user()->photoFullUrl}}" class="w-11 h-11 min-w-11 min-h-11 rounded-full">
                                </div>
                                {{-- ATENÇÃO - ALTERAR FORMULA DE CALCULO DAS LARGURAS MÁXIMAS QUANDO O MENU FOR ALTERADO --}}
                                <div class="ps-1 sm:max-w-[calc(100vw-39rem)] md:max-w-[calc(100vw-41rem)] lg:max-w-[calc(100vw-46rem)] xl:max-w-[34rem] truncate">
                                    {{ Auth::user()->name }}
                                </div>
                                </x-slot>
                                @auth
                                <hr>
                                <x-menus.submenu-item content="Perfil" selectable="0" :href="match(Auth::user()->type) {
                                    'A' => route('administratives.show', ['administrative' => Auth::user()]),
                                    'E' => route('employees.show', ['employee' => Auth::user()]),
                                    'C' => route('customers.show', ['user' => Auth::user()]),
                                }" />
                                <x-menus.submenu-item content="Minhas Compras" selectable="1" href="{{ route('purchases.index') }}" selected="{{ Route::currentRouteName() == 'purchases.index'}}" />
                                <x-menus.submenu-item content="Mudar Palavra-passe" selectable="0" href="{{ route('profile.edit.password') }}" />

                                @endauth
                                <hr class="border-gray-200">
                                <form id="form_to_logout_from_menu" method="POST" action="{{ route('logout') }}" class="hidden">
                                    @csrf
                                </form>
                                <x-menus.submenu-item content="Log Out" selectable="0" form="form_to_logout_from_menu" />
                        </x-menus.submenu>
                        @else
                        <!-- Menu Item: Login -->
                        <x-menus.menu-item content="Login" selectable="1" href="{{ route('login') }}" selected="{{ Route::currentRouteName() == 'login'}}" />
                        <x-menus.menu-item content="Sign Up" selectable="1" href="{{ route('register') }}" selected="{{ Route::currentRouteName() == 'register'}}" />
                        @endauth
                    </div>
                    <!-- Hamburger -->
                    <div class="absolute right-0 top-0 flex sm:hidden pt-3 pe-3 text-primary-gray dark:text-gray-50">
                        <button id="hamburger_btn">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path id="hamburger_btn_open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path class="invisible" id="hamburger_btn_close" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <header class="max-w-7xl bg-white mx-auto dark:bg-gray-900">
            <div class="pt-6 py-2 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    @yield('header-title')
                </h2>
            </div>
        </header>

        <main>
            <div class="max-w-7xl bg-white h-auto mx-auto py-2 sm:px-6 lg:px-8">
                @if (session('alert-msg'))
                <x-alert type="{{ session('alert-type') ?? 'info' }}">
                    {!! session('alert-msg') !!}
                </x-alert>
                @endif
                @if (!$errors->isEmpty())
                <x-alert type="warning" message="Operation failed because there are validation errors!" />
                @endif

                @yield('main')
            </div>
        </main>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';

            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    });
</script>

</html>