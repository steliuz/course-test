<div>
    @if ($show)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-60 transition-opacity duration-300">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4 md:mx-auto overflow-hidden transform transition-all duration-300 ease-in-out">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-center text-gray-900 dark:text-white mb-2">{{ $title }}</h3>
                    <p class="text-sm text-center text-gray-500 dark:text-gray-400">¿Estás seguro que deseas eliminar {{ $name }}? Esta acción no se puede deshacer.</p>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex flex-col sm:flex-row gap-2 justify-center">
                    <button type="button" wire:click="$emit('cancelDelete')" class="w-full sm:w-auto px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="button" wire:click="$emit('confirmDeleteAction')" class="w-full sm:w-auto px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
