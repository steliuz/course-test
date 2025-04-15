<div>
    <div class="container">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Gestión Matrículas</h2>
    </div>
    <div class=" bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-primary dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 uppercase text-white text-left">Estudiante</th>
                    <th class="px-4 py-2 uppercase text-white text-left">Curso</th>
                    <th class="px-4 py-2 uppercase text-white">Estado</th>
                    <th class="px-6 py-3 uppercase text-white text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($enrollments as $enrollment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <td class="px-6 py-4 ">{{ $enrollment->student->first_name }}
                            {{ $enrollment->student->last_name }}</td>
                        <td class="px-6 py-4 ">{{ $enrollment->course->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $enrollment->status === 'active' ? 'bg-green-100 text-green-800' : ($enrollment->status === 'inactive' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}"
                            >
                                {{ $enrollment->status === 'active' ? 'Activa' : ($enrollment->status === 'inactive' ? 'Inactiva' : 'Pendiente') }}
                            </span>
                        </td>
                        @if($enrollment->status === 'pending')
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="openPaymentModal({{ $enrollment->id }})"
                                class="inline-flex items-center justify-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Ver Pago
                            </button>
                        </td>
                        @else
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            No disponible
                        </td>
                        @endif
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

    <!-- Modal de Pago -->
    <div>
        @if ($isPaymentModalOpen)
            <div x-data="{
                show: @entangle('isPaymentModalOpen'),
                processing: @entangle('processing')
            }" x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75 backdrop-blur-sm">
                <div @click.away="$wire.closePaymentModal()"
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md mx-4 md:mx-auto overflow-hidden transform transition-all">
                    <!-- Encabezado del modal -->
                    <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Detalles del Pago</h2>
                        <button type="button" wire:click="closePaymentModal"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Contenido del modal -->
                    <div class="px-6 py-4 space-y-6">
                        <!-- Vista principal -->
                        @if ($confirmAction === '')
                            <!-- Estado del pago -->
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado:</span>
                                <div>
                                    @switch(strtolower($paymentDetails['status'] ?? 'pendiente'))
                                        @case('pendiente')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Pendiente
                                            </span>
                                        @break

                                        @case('accepted')
                                        @case('aceptado')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Aceptado
                                            </span>
                                        @break

                                        @case('rejected')
                                        @case('rechazado')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Rechazado
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $paymentDetails['status'] }}
                                            </span>
                                    @endswitch
                                </div>
                            </div>

                            <!-- Monto -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Monto:</span>
                                    <span
                                        class="text-2xl font-bold text-gray-800 dark:text-white">${{ number_format((float) $paymentDetails['cost'], 2) }}</span>
                                </div>
                            </div>

                            <!-- Información del curso -->
                            <div class="border-t dark:border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Curso:</h4>
                                <p class="font-medium text-gray-800 dark:text-white">
                                    {{ $selectedEnrollment->course->title ?? 'N/A' }}</p>

                                <div class="mt-2 flex flex-wrap gap-2">
                                    @if (isset($paymentDetails['duration']))
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $paymentDetails['duration'] }} horas
                                        </span>
                                    @endif

                                    @if (isset($paymentDetails['modality']))
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                            {{ $paymentDetails['modality'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Información del estudiante -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Estudiante:</h4>
                                <p class="font-medium text-gray-800 dark:text-white">
                                    {{$selectedEnrollment->student->first_name ?? 'N/A'}}
                                    {{$selectedEnrollment->student->last_name ?? 'N/A'}}
                                </p>
                                </p>
                            </div>

                            <!-- Método de pago -->
                            <div class="flex items-center">
                                <i class="fa-solid fa-credit-card text-gray-500 mr-3"></i>
                                <span
                                    class="text-sm text-gray-600 dark:text-gray-300">{{ $paymentDetails['payment_method'] == 'transfer' ? 'Transferencia bancaria' : 'Efectivo' }}
                                </span>
                            </div>

                            <!-- Fecha -->
                            <div class="flex items-center">
                                <i class="fa-solid fa-calendar-xmark text-gray-500 mr-3"></i>
                                <span class="text-sm text-gray-600 dark:text-gray-300">Fecha:
                                    {{ $paymentDetails['date'] ?? now()->format('d/m/Y') }}</span>
                            </div>
                        @endif

                        <!-- Confirmación de aceptación -->
                        @if ($confirmAction === 'accept')
                            <div class="bg-green-50 dark:bg-green-900 border-l-4 border-green-400 p-4 rounded">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Confirmar
                                            aceptación</h3>
                                        <div class="mt-2 text-sm text-green-700 dark:text-green-300">
                                            <p>¿Estás seguro que deseas aceptar este pago por
                                                ${{ number_format((float) $paymentDetails['cost'], 2) }}?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Confirmación de rechazo -->
                        @if ($confirmAction === 'reject')
                            <div class="bg-red-50 dark:bg-red-900 border-l-4 border-red-400 p-4 rounded">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Confirmar
                                            rechazo</h3>
                                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                            <p>¿Estás seguro que deseas rechazar este pago? Esta acción no se puede
                                                deshacer.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Pie del modal con botones -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t dark:border-gray-600">
                        @if ($confirmAction === '')
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-3">
                                <button wire:click="closePaymentModal"
                                    class="w-full sm:w-auto order-2 sm:order-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                    Cancelar
                                </button>
                                <div class="flex gap-2 w-full sm:w-auto order-1 sm:order-2">
                                    <button wire:click="startRejectPayment"
                                        class="flex-1 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors flex items-center justify-center">
                                        <i class="fa-solid fa-xmark mr-2 text-white"></i>
                                        Rechazar
                                    </button>
                                    <button wire:click="startAcceptPayment"
                                        class="flex-1 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors flex items-center justify-center">
                                        <i class="fa-solid fa-check mr-2 text-white"></i>
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        @elseif ($confirmAction === 'accept')
                            <div class="flex gap-2 w-full">
                                <button wire:click="cancelConfirmation"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors"
                                    :disabled="processing">
                                    Cancelar
                                </button>
                                <button wire:click="updatePaymentStatus('accepted')"
                                    class="flex-1 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors flex items-center justify-center"
                                    :disabled="processing">
                                    <template x-if="processing">
                                        <div class="flex items-center">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            Procesando...
                                        </div>
                                    </template>
                                    <template x-if="!processing">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Confirmar
                                        </div>
                                    </template>
                                </button>
                            </div>
                        @elseif ($confirmAction === 'reject')
                            <div class="flex gap-2 w-full">
                                <button wire:click="cancelConfirmation"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors"
                                    :disabled="processing">
                                    Cancelar
                                </button>
                                <button wire:click="updatePaymentStatus('rejected')"
                                    class="flex-1 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors flex items-center justify-center"
                                    :disabled="processing">
                                    <template x-if="processing">
                                        <div class="flex items-center">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            Procesando...
                                        </div>
                                    </template>
                                    <template x-if="!processing">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Confirmar rechazo
                                        </div>
                                    </template>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
