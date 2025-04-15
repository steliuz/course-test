<header class="bg-gray-900 ">
    <div class=" mx-auto  sm:px-6 lg:px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Left side: Logo and menu toggle -->
            <div class="flex items-center space-x-4">
                <button @click="$dispatch('toggle-sidebar')"
                    class="lg:hidden text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white rounded-md p-1">
                    <span class="sr-only">Abrir menú</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <div class="flex items-center">
                    <i class="fa-solid fa-layer-group text-green-500 fa-2xl"></i>

                    <h1 class="ml-2 text-xl font-bold text-white">Course App</h1>
                </div>
            </div>

            <!-- Right side: Search, notifications, and profile -->
            <div class="flex items-center space-x-4">
                <!-- Search - Hidden on mobile -->
                <div class="hidden md:block relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text"
                        class="h-8 w-48 pl-10 pr-3 py-1 rounded-md bg-gray-800 border border-gray-700 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Buscar...">
                </div>

                <livewire:general.navbar-notifications />

                <!-- Profile dropdown -->
                @if (Auth::check())
                    <div x-data="{ open: false }" class="relative">
                        <div>
                            <button @click="open = !open" type="button"
                                class="flex items-center max-w-xs text-sm rounded-full   focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Abrir menú de usuario</span>
                                <div
                                    class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-white border-2 border-blue-500">
                                    <span class="font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span
                                    class="ml-2 text-sm font-medium text-white hidden md:block">{{ Auth::user()->name }}</span>
                                <svg class="ml-1 h-5 w-5 text-gray-400 hidden md:block"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <!-- Profile Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" style="display: none;">
                            <div class="py-1">
                                <div class="px-4 py-2 border-b border-gray-700">
                                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                                {{-- <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Mi
                                    Perfil</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Configuración</a> --}}
                                <div class="border-t border-gray-700">
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300"
                                        wire:click.prevent="logout">
                                        Cerrar Sesión
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
