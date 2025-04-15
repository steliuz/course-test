<div class=" bg-white dark:bg-gray-800 rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
        <thead class="bg-secondary dark:bg-gray-700">
            <tr>
                @if ($type === 'academy')
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-300 uppercase ">
                        Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-300 uppercase ">
                        Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-300 uppercase ">
                        Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-300 uppercase ">
                        Cursos</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-800 dark:text-gray-300 uppercase ">
                        Acciones</th>
                @else
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Costo</th>
                    <th class="px-4 py-2">Duración</th>
                    <th class="px-4 py-2">Academia</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-800 dark:text-gray-300 uppercase ">
                        Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($items as $item)
                <tr wire:key="item-{{ $item->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    @if ($type === 'academy')
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }} </td>
                        <td class="px-6 py-4">{{ $item->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->status === 'active' ? 'Activa' : 'Inactiva' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-center">
                                <span
                                    class="px-3 py-2 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">
                                    {{ $item->courses->count() }}
                                </span>
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
                                        <button wire:click="showCourses({{ $item->id }})"
                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-blue-500  hover:bg-blue-100 dark:hover:bg-gray-700 w-full text-left">
                                            <i class="fa-solid fa-book-open mr-3 "></i>
                                            Ver Cursos
                                        </button>
                                    </div>
                                    <div class="py-1">
                                        <button onclick="Livewire.dispatch('editItem', { id: {{ $item->id }} })"
                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-green-500  hover:bg-green-100 dark:hover:bg-gray-700 w-full text-left">
                                            <i class="fa-solid fa-pen-to-square mr-3"></i>
                                            Editar
                                        </button>
                                    </div>
                                    <div class="py-1">
                                        <button
                                            onclick="Livewire.dispatch('showDeleteModal', { title: 'Eliminar Academia', type: '{{ $type }}', name: '{{ $item->name }}', id: {{ $item->id }} })"
                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/20 w-full text-left">
                                            <i class="fa-solid fa-trash mr-3"></i>
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    @else
                        <td class="border px-4 py-2">{{ $item->title }}</td>
                        <td class="border px-4 py-2">{{ $item->description }}</td>
                        <td class="border px-4 py-2">{{ $item->cost }} $</td>
                        <td class="border px-4 py-2">{{ $item->duration }} Min</td>
                        <td class="border px-4 py-2">
                            <div class="text-center">
                                <span
                                    class="px-3 py-2 inline-flex text-xs bg-blue-100 text-blue-800">
                                    {{ $item->academy->name }}
                                </span>
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
                                            <button onclick="Livewire.dispatch('editItemCourse', { id: {{ $item->id }} })"
                                                class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-green-500  hover:bg-green-100 dark:hover:bg-gray-700 w-full text-left">
                                                <i class="fa-solid fa-pen-to-square mr-3"></i>
                                                Editar
                                            </button>
                                        </div>
                                        <div class="py-1">
                                            <button
                                                onclick="Livewire.dispatch('showDeleteModal', { title: 'Eliminar Curso', type: 'course', name: '{{ $item->title }}', id: {{ $item->id }} })"
                                                class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/20 w-full text-left">
                                                <i class="fa-solid fa-trash mr-3"></i>
                                                Eliminar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    @endif
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
    <livewire:general.moda-confirm-delete />
</div>
