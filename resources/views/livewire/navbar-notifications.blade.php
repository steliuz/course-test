<div>
    <!-- Notifications -->
    @if (Auth::user()->role !== 'admin')
        <div x-data="{ open: false, messages: @entangle('messages'), loading: @entangle('loading') }" class="relative">
            <button @click="open = !open" type="button"
                class="relative p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span class="sr-only">Ver notificaciones</span>
                <i class="fa-solid fa-bell fa-lg"></i>
                <span x-show="messages.length > 0"
                    class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-gray-900"></span>
            </button>

            <!-- Notification Dropdown -->
            <div x-show="open" @click.away="open = false"
                class="origin-top-right absolute right-0 mt-2 w-96 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" style="display: none;">
                <div class="py-1">
                    <div class="px-4 py-2 border-b border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-white">Notificaciones</h3>
                        </div>
                    </div>

                    <!-- Loading Spinner -->
                    <div x-show="loading" class="flex justify-center py-4">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </div>

                    <!-- Notification Items -->
                    <div x-show="!loading" class="max-h-96 overflow-y-auto scroll-smooth ">
                        <template x-if="messages.length > 0">
                            <div>
                                <div class="px-4 py-2 text-sm text-gray-400">
                                    Total de notificaciones: <span x-text="messages.length"></span>
                                </div>
                                <template x-for="(message, index) in messages" :key="index">
                                    <a href="#"
                                        class="block px-6 py-4 hover:bg-gray-700 transition-colors duration-150">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="h-8 w-8 rounded-full flex items-center justify-center"
                                                    :class="index % 2 === 0 ? 'bg-blue-500/20 text-blue-400' : 'bg-green-500/20 text-green-400'">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4 w-full">
                                                <p class="text-sm font-medium text-white" x-text="message.title"></p>
                                                <p class="text-xs text-gray-400" x-text="message.content"></p>
                                                <p class="text-xs text-gray-400 mt-1 text-right" x-text="new Date(message.pivot.created_at).toLocaleString()"></p>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </template>
                        <template x-if="messages.length === 0">
                            <p class="text-sm text-gray-400 text-center py-4">No tiene notificaciones</p>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
