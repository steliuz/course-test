<div>
    <div class="container">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Gestión Estudiantes</h2>
    </div>
    <div class="flex justify-end items-center my-4 gap-3">

        <button onclick="Livewire.dispatch('openModalStudent')"
            class="bg-primary hover:bg-secondary/90 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Nuevo Estudiante
        </button>
    </div>
    <div class=" bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-primary dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 uppercase text-white text-left">Nombre</th>
                    <th class="px-4 py-2 uppercase text-white">Apellido</th>
                    <th class="px-4 py-2 uppercase text-white">F. Nacimiento</th>
                    <th class="px-6 py-3 uppercase text-white ">
                        Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($students as $student)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <td class="px-6 py-4 ">{{ $student->first_name }}</td>
                        <td class="px-6 py-4 text-center">{{ $student->last_name }}</td>
                        <td class="px-6 py-4 text-center">{{ $student->date_of_birth }}</td>
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
                                        <button
                                        onclick="Livewire.dispatch('editItemStudent', { id: {{ $student->id }} })"
                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-green-500  hover:bg-green-100 dark:hover:bg-gray-700 w-full text-left">
                                            <i class="fa-solid fa-pen-to-square mr-3"></i>
                                            Editar
                                        </button>
                                    </div>
                                    <div class="py-1">
                                        <button
                                         onclick="Livewire.dispatch('showDeleteModal', { title: 'Eliminar Estudiante', type: 'student', name: '{{ $student->first_name }} {{$student->last_name}}', id: {{ $student->id }} })"
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
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            No hay datos disponibles.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modals -->
    <livewire:modal-create-student />
    <livewire:moda-confirm-delete />
</div>
