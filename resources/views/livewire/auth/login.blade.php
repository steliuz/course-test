<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 grid place-items-center p-4">
    <div class="w-full max-w-md bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="bg-blue-600 p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h1 class="text-2xl font-bold mt-3 text-white">Course App</h1>
        </div>
        
        <div class="p-8">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Iniciar Sesión</h2>
            
            <form wire:submit.prevent="login" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input
                            id="email"
                            type="email"
                            wire:model="email"
                            class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="tu@email.com"
                        />
                    </div>
                    @error('email') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <a href="#" class="text-xs text-blue-600 hover:text-blue-800 transition-colors">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            id="password"
                            type="password"
                            wire:model="password"
                            class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="••••••••"
                        />
                    </div>
                    @error('password') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                        Recordarme
                    </label>
                </div>
                
                <button
                    type="submit"
                    class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 font-medium"
                >
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </div>
</div>