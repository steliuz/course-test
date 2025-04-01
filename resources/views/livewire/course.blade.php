<div>
    <div class="container">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Gestión de Academias y Cursos</h2>


        <div x-data="{ activeTab: 'academies' }">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                    <button @click="activeTab = 'academies'"
                        :class="activeTab === 'academies' ? 'border-primary text-primary' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                        class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 transition-colors duration-200">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Academias</span>
                        <span
                            class="ml-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 py-0.5 px-2.5 rounded-full text-xs font-medium">
                            {{ count($academies) }}
                        </span>
                    </button>
                    <button @click="activeTab = 'courses'"
                        :class="activeTab === 'courses' ? 'border-primary text-primary' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                        class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 transition-colors duration-200">
                        <i class="fa-solid fa-book-open mr-3 "></i>
                        <span>Cursos</span>
                        <span
                            class="ml-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 py-0.5 px-2.5 rounded-full text-xs font-medium">
                            {{ count($courses) }}
                        </span>
                    </button>
                </nav>
            </div>

            <div class="flex justify-end items-center my-4 gap-3">
                <button x-show="activeTab === 'academies'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="bg-secondary hover:bg-secondary/90 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 flex items-center gap-2"
                    onclick="Livewire.dispatch('dispatchCreateAcademyModal')">
                    <i class="fa-solid fa-plus"></i>
                    Nueva Academia
                </button>

                <button x-show="activeTab === 'courses'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 flex items-center gap-2"
                    onclick="Livewire.dispatch('dispatchCreateCourseModal')">
                    <i class="fa-solid fa-plus"></i>
                    Nuevo Curso
                </button>
            </div>

            <div class="mt-4">
                <div x-show="activeTab === 'academies'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-4">
                    <livewire:table-component-courses :items="$academies" type="academy" :key="'academies-' . now()->timestamp" />
                </div>

                <div x-show="activeTab === 'courses'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-4">
                    <livewire:table-component-courses :items="$courses" type="course" :key="'courses-' . now()->timestamp" />
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <livewire:modal-create-academy />
    <livewire:modal-create-course />
</div>
