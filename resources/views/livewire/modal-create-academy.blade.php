<div>
    @if ($isOpen)
        <div
            class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-60 transition-opacity duration-300">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4 md:mx-auto overflow-hidden transform transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Crear Academia</h2>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-4">
                    <form wire:submit.prevent="saveAcademy">
                        
                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                            <input type="text" id="name" wire:model="name"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Nombre de la academia">
                            @error('name')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea id="description" wire:model="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Descripción de la academia"></textarea>
                            @error('description')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estatus</label>
                            <div class="flex items-center gap-3">
                                <button type="button" wire:click="$set('status', 'active')"
                                    class="px-3 py-1 rounded-md font-medium shadow-sm transition-colors duration-200 focus:outline-none 
                                    {{ $status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                                    Activa
                                </button>
                                <button type="button" wire:click="$set('status', 'inactive')"
                                    class="px-3 py-1 rounded-md font-medium shadow-sm transition-colors duration-200 focus:outline-none 
                                    {{ $status === 'inactive' ? 'bg-red-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                                    Inactiva
                                </button>
                            </div>
                            @error('status')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                    </form>
                </div>

                <div class="px-6 py-4  dark:bg-gray-700 flex flex-col gap-2 ">
                    <button type="button" wire:click="closeModal"
                        class="w-full sm:w-auto px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="button" wire:click="saveAcademy"
                        class="w-full sm:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Guardar
                    </button>

                </div>
            </div>
        </div>
    @endif
</div>
