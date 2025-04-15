<div>
    @if ($isOpen)
        <div
            class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-60 transition-opacity duration-300">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-lg mx-4 md:mx-auto overflow-hidden transform transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Crear Curso</h2>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-4">
                    <form wire:submit.prevent="saveCourse">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="mb-4">
                                    <label for="title"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título</label>
                                    <input type="text" id="title" wire:model="title"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                        placeholder="Título del curso">
                                    @error('title')
                                        <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="modality"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Modalidad</label>
                                    <select id="modality" wire:model="modality"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                        <option value="">Seleccione una modalidad</option>
                                        <option value="Online">Online</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                    @error('modality')
                                        <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <!-- Right Column -->
                            <div>
                                <div class="mb-4">
                                    <label for="cost"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Costo</label>
                                    <input type="number" id="cost" wire:model="cost" step="0.01"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                        placeholder="Costo del curso">
                                    @error('cost')
                                        <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="duration"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duración
                                        (horas)</label>
                                    <input type="number" id="duration" wire:model="duration"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                        placeholder="Duración del curso">
                                    @error('duration')
                                        <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>




                            </div>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estatus</label>
                            <div class="flex items-center gap-3">
                                <button type="button" wire:click="$set('status', 'active')"
                                    class="px-3 py-1 rounded-md font-medium shadow-sm transition-colors duration-200 focus:outline-none 
                                    {{ $status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                                    Activo
                                </button>
                                <button type="button" wire:click="$set('status', 'inactive')"
                                    class="px-3 py-1 rounded-md font-medium shadow-sm transition-colors duration-200 focus:outline-none 
                                    {{ $status === 'inactive' ? 'bg-red-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                                    Inactivo
                                </button>
                            </div>
                            @error('status')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="academy"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Academia</label>
                            <select id="academy" wire:model="academy"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccione una academia</option>
                                @foreach ($academies as $academy)
                                    <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                                @endforeach
                            </select>
                            @error('academy')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea id="description" wire:model="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Descripción del curso"></textarea>
                            @error('description')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>


                    </form>
                </div>

                <div class="px-6 py-4 dark:bg-gray-700 flex flex-col gap-2">
                    <button type="button" wire:click="closeModal"
                        class="w-full sm:w-auto px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="button" wire:click="saveCourse"
                        class="w-full sm:w-auto px-4 py-2 bg-primary hover:bg-blue-800 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
