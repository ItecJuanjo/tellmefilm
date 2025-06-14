<nav x-data="{ open: false }" class="bg-naranja text-white border-b border-orange-300">
    <div class="max-w-7xl mx-auto pl-4 pr-2 sm:pl-6 sm:pr-2 lg:pl-4 lg:pr-0">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('storage/logo/logo.png') }}" alt="TellMeFilm Logo" class="h-10 w-10 mr-2">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-gray-200">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link :href="route('peliculas.index')" :active="request()->routeIs('peliculas.*')" class="text-white hover:text-gray-200">
                        {{ __('Películas') }}
                    </x-nav-link>

                    @auth
                        @if (Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')" class="text-white hover:text-gray-200">
                                {{ __('Admin') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex gap-4">
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 font-medium transition">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="text-white hover:text-gray-200 font-medium transition">Registrarse</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- Responsive --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-gray-200">
                {{ __('Inicio') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('peliculas.index')" :active="request()->routeIs('peliculas.*')" class="text-white hover:text-gray-200">
                {{ __('Películas') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('perfil.edit')" :active="request()->routeIs('perfil.edit')" class="text-white hover:text-gray-200">
                    {{ __('Mi perfil') }}
                </x-responsive-nav-link>

                @if (Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')" class="text-white hover:text-gray-200">
                        {{ __('Admin') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-orange-300">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-orange-100">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:text-gray-200">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="block text-white hover:text-gray-200">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="block text-white hover:text-gray-200">Registrarse</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
