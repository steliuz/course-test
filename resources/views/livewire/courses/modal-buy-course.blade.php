<div>
    @if ($isOpen)
        <div
            class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75 backdrop-blur-sm transition-opacity duration-300">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-5xl mx-4 md:mx-auto overflow-hidden transform transition-all duration-300 ease-in-out animate-fadeIn">
                <!-- Header -->
                <div
                    class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-750">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Comprar Curso
                    </h2>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary rounded-full p-1 transition-colors duration-200">
                        <span class="sr-only">Cerrar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Contenido en dos columnas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Columna izquierda - Información del curso -->
                    <div class="px-6 py-4">
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $course['title'] }}
                                </h3>
                                <span
                                    class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium">{{ $course['modality'] }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $course['description'] }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Precio</div>
                                    <div class="text-lg font-bold text-gray-800 dark:text-white">
                                        ${{ number_format($course['cost'], 2) }}</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Duración</div>
                                    <div class="text-lg font-bold text-gray-800 dark:text-white">
                                        {{ $course['duration'] }}
                                        horas</div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Detalles del
                                    curso:
                                </h4>
                                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Acceso inmediato al contenido
                                    </li>
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Certificado de finalización
                                    </li>
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Soporte técnico
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="student"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Estudiante a registrar
                            </label>
                            <select id="student" wire:model="student"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Selecciona un estudiante</option>
                                @foreach ($myStudents as $student)
                                    <option value="{{ $student['id'] }}">{{ $student['first_name'] }}
                                        {{ $student['last_name'] }}</option>
                                @endforeach
                            </select>
                            @error('student')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna derecha - Método de pago -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-750">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Información de Pago</h3>

                        <div class="mb-4">
                            <label for="payment_method"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Método de pago
                            </label>
                            <select id="payment_method" wire:model.live="paymentMethod"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Seleccionar método de pago</option>
                                <option value="cash">Efectivo</option>
                                <option value="transfer">Transferencia bancaria</option>
                            </select>
                            @error('paymentMethod')
                                <span class="mt-1 text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($paymentMethod === 'transfer')
                            <div
                                class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-md border border-blue-100 dark:border-blue-800">
                                <h4 class="text-sm font-medium text-blue-800 dark:text-blue-300 mb-2">Instrucciones para
                                    transferencia:</h4>
                                <p class="text-sm text-blue-700 dark:text-blue-400">
                                    Realiza la transferencia a la siguiente cuenta bancaria:
                                </p>
                                <ul class="text-sm text-blue-700 dark:text-blue-400 mt-2 space-y-1">
                                    <li>Banco: Banco Nacional</li>
                                    <li>Titular: Academia Educativa S.A.</li>
                                    <li>Cuenta: 1234-5678-9012-3456</li>
                                    <li>Referencia: Curso-{{ $course['id'] }}</li>
                                </ul>
                            </div>
                        @elseif($paymentMethod === 'cash')
                            <div
                                class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-md border border-green-100 dark:border-green-800">
                                <h4 class="text-sm font-medium text-green-800 dark:text-green-300 mb-2">Pago en
                                    efectivo:
                                </h4>
                                <p class="text-sm text-green-700 dark:text-green-400">
                                    Puedes realizar el pago en efectivo en nuestras oficinas ubicadas en:
                                </p>
                                <p class="text-sm text-green-700 dark:text-green-400 mt-2">
                                    Av. Principal #123, Edificio Central, Piso 2.<br>
                                    Horario: Lunes a Viernes de 9:00 AM a 5:00 PM
                                </p>
                            </div>
                        @endif

                        <!-- Botones de acción -->
                        <div class="mt-6 flex flex-col gap-2">
                            <button type="button" wire:click="closeModal"
                                class="w-full px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                Cancelar
                            </button>
                            <button type="button" wire:click="registerEnrollment"
                                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <i class="fa-solid fa-cart-arrow-down text-white"></i>
                                Confirmar Compra
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
