<div class="container mx-auto p-6">
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-bold mb-2 text-gray-800">Academias y Cursos Disponibles</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Explora nuestra selección de academias de alta calidad y cursos
            diseñados para impulsar tu carrera profesional.</p>
    </div>

    <!-- Academias -->
    {{-- <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fa-solid fa-building-columns mr-2 text-indigo-600"></i>
                Academias
            </h3>
            <div class="flex space-x-2">
                <span class="text-sm text-gray-500">{{ count($academies) }} academias disponibles</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($academies as $academy)
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-lg mr-4">
                                    <i class="fa-solid fa-graduation-cap text-xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-800">{{ $academy['name'] }}</h4>
                            </div>
                            <span
                                class="bg-indigo-100 text-indigo-600 text-xs font-medium px-2.5 py-0.5 rounded-full">Academia</span>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $academy['description'] }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fa-solid fa-book-open mr-1"></i>
                                <span>{{ rand(5, 20) }} cursos</span>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                                Ver detalles
                                <i class="fa-solid fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}

    <!-- Cursos -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fa-solid fa-book mr-2 text-emerald-600"></i>
                Cursos Destacados
            </h3>
            <div class="flex space-x-2">
                <span class="text-sm text-gray-500">{{ count($courses) }} cursos disponibles</span>
            </div>
        </div>

        <!-- filepath: c:\xampp\htdocs\test-ecuador\resources\views\livewire\courses-list.blade.php -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($courses as $course)
            {{-- @json($course) --}}
                <div
                    class="bg-white border h-[300px] border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden group relative">
                    <div class="relative">
                        <div class="flex justify-around items-center mt-3">
                            <span
                                class="bg-white/90 backdrop-blur-sm text-gray-800 text-md font-medium px-2.5 py-1 rounded-full">
                                {{ $course['modality'] ?? 'Online' }}
                            </span>
                            <span class="bg-primary text-white text-sm font-bold px-3 py-1 rounded-full">
                                ${{ number_format($course['cost'], 2) }} USD
                            </span>
                        </div>
                    </div>

                    <div class="p-5 pt-6">
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 flex items-center mb-1">
                                <i class="fa-solid fa-building mr-1"></i>
                                {{ $course['academy']['name'] ?? 'Academia no disponible' }}
                            </p>
                            <h3
                                class="text-lg font-bold text-gray-800 line-clamp-2 group-hover:text-emerald-600 transition-colors h-12">
                                {{ $course['title'] }}
                            </h3>
                        </div>

                        <!-- Fixed height for description -->
                        <p class="text-sm text-gray-600 line-clamp-2 mb-4 h-14 overflow-auto">
                            {{ $course['description'] }}
                        </p>

                        <!-- Align hours and students below description -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fa-solid fa-clock mr-1"></i>
                                <span>{{ $course['duration'] ?? rand(10, 60) }} horas</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fa-solid fa-users mr-1"></i>
                                <span>{{ rand(10, 100) }} estudiantes</span>
                            </div>
                        </div>

                        <div class="flex justify-center px-4 absolute bottom-2 left-0 right-0">
                            <button type="button" wire:click="courseBuy({{ $course['id'] }})"
                                class="w-full bg-green-500 hover:bg-green-400 text-white font-medium py-2 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fa-solid fa-cart-shopping mr-2"></i>
                                Comprar Curso
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <livewire:courses.modal-buy-course />
</div>
