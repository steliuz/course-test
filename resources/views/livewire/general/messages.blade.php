<div>
    <div class="container">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Gestión de Mensajes</h2>
    </div>
    <div class="flex justify-end items-center my-4 gap-3">
        <button wire:click='openModal'
            class="bg-primary hover:bg-secondary/90 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Nueva Notificación
        </button>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-primary dark:bg-gray-700">
                <tr></tr>
                    <th class="px-4 py-2 uppercase text-white text-left">Título</th>
                    <th class="px-4 py-2 uppercase text-white text-left">Contenido</th>
                    <th class="px-4 py-2 uppercase text-white">Fecha de Creación</th>
                    <th class="px-6 py-3 uppercase text-white">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($messages as $message)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <td class="px-6 py-4">{{ $message['title'] }}</td>
                        <td class="px-6 py-4 text-left">{{ $message['content'] }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg px-3 py-1.5 flex items-center gap-2 shadow-sm">
                                    <i class="fa-regular fa-calendar-days text-blue-500 dark:text-blue-400"></i>
                                    <span class="text-gray-700 dark:text-gray-200 font-medium ml-1">
                                        {{ $this->formatDate($message['created_at']) }}
                                    </span>
                                </div>
                            </div>
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="relative text-center" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fa-solid fa-bars fa-md"></i>
                                </button>
                                <div x-show="open" @click.away="open = false"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700 focus:outline-none z-10"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="py-1">
                                        <button wire:click="resendMessage({{ $message['id'] }})"
                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-blue-500 hover:bg-blue-100 dark:hover:bg-gray-700 w-full text-left">
                                            <i class="fa-solid fa-paper-plane mr-3"></i>
                                            Reenviar
                                        </button>
                                    </div>
                                    <div class="py-1">
                                        <button
                                            onclick="Livewire.dispatch('showDeleteModal', { title: 'Eliminar Mensaje', type: 'message', name: '{{ $message['title'] }}', id: {{ $message['id'] }} })"
                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/20 w-full text-left">
                                            <i class="fa-solid fa-trash mr-3"></i>
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            No hay datos disponibles.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($isOpen)
        <div
            class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-60 transition-opacity duration-300">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-xl mx-4 md:mx-auto overflow-hidden transform transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                        {{ isset($messageId) && $messageId ? 'Editar Mensaje' : 'Enviar Notificación' }}
                    </h2>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>

                <div class="px-6 py-4">
                    <form wire:submit.prevent="saveMessage">
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 text-center">
                                Tipo de Mensaje
                            </label>
                            <div class="flex justify-center items-center gap-3 mb-5">
                                <button type="button" wire:click="$set('type', 'Todos')"
                                    class="px-5 py-2.5 rounded-md font-medium shadow-sm transition-colors duration-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary min-w-[100px]
                                {{ $type === 'Todos' ? 'bg-primary text-white ' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-400/90 dark:hover:bg-green-400/70' }}">
                                    <i class="fa-solid fa-users mr-2"></i>Todos
                                </button>
                                <button type="button" wire:click="$set('type', 'Curso')"
                                    class="px-5 py-2.5 rounded-md font-medium shadow-sm transition-colors duration-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 min-w-[100px]
                                {{ $type === 'Curso' ? 'bg-primary text-white ' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-400/90 dark:hover:bg-green-400/70' }}">
                                    <i class="fa-solid fa-graduation-cap mr-2"></i>Curso
                                </button>
                                <button type="button" wire:click="$set('type', 'Edad')"
                                    class="px-5 py-2.5 rounded-md font-medium shadow-sm transition-colors duration-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 min-w-[100px]
                                {{ $type === 'Edad' ? 'bg-primary text-white ' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-purple-500/90 dark:hover:bg-purple-500/70' }}">
                                    <i class="fa-solid fa-child mr-2"></i>Edad
                                </button>
                            </div>
                            @error('type')
                                <span class="mt-1 text-red-500 text-sm text-center block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Filtros (Curso y Edad) en una fila completa -->
                        <div class="mb-4">
                            <div x-data="{ type: @entangle('type') }">
                                <div x-show="type === 'Curso'" class="transition-all duration-200">
                                    <label for="course_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Curso</label>
                                    <select id="course_id" wire:model="course_id"
                                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                        <option value="">Seleccione un curso</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div x-show="type === 'Edad'" class="transition-all duration-200">
                                    <label for="age"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Edad</label>
                                    <input type="number" id="age" wire:model="age"
                                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                        placeholder="Edad">
                                    @error('age')
                                        <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Título en una fila completa -->
                        <div class="mb-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título</label>
                            <input type="text" id="title" wire:model="title"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Título del mensaje">
                            @error('title')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contenido en una fila completa -->
                        <div class="mb-4">
                            <label for="content"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contenido</label>
                            <textarea id="content" wire:model="content" rows="5"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white resize-none"
                                placeholder="Contenido del mensaje"></textarea>
                            @error('content')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>

                <div class="px-6 py-4 dark:bg-gray-700 flex flex-col gap-2">
                    <button type="button" wire:click="closeModal"
                        class="px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="button" wire:click="saveMessage"
                        class="w-full sm:w-auto px-4 py-2 bg-primary hover:bg-blue-800 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    @endif




</div>
