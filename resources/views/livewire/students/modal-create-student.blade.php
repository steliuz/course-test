<div>
    @if ($isOpen)
        <div
            class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-60 transition-opacity duration-300">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4 md:mx-auto overflow-hidden transform transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Crear Nuevo Estudiante</h2>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fa-solid fa-xmark fa-lg "></i>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <form >
                        <div class="mb-4">
                            <label for="first_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                            <input type="text" id="first_name" wire:model="data.first_name"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Nombre del estudiante">
                        </div>
                        <div class="mb-4">
                            <label for="last_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Apellido</label>
                            <input type="text" id="last_name" wire:model="data.last_name"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Apellido del estudiante">
                        </div>
                        <div class="mb-4">
                            <label for="date_of_birth"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha
                                de Nacimiento</label>
                            <input type="date" id="date_of_birth" wire:model="data.date_of_birth"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        
                    </form>
                </div>
                <div class="px-6 py-4  dark:bg-gray-700 flex flex-col gap-2 ">
                    <button  wire:click="closeModal"
                        class="w-full sm:w-auto px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button wire:click="saveStudent"
                        class="w-full sm:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Guardar
                    </button>

                </div>
            </div>
        </div>
    @endif
</div>
