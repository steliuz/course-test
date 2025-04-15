<div class="min-h-screen bg-gray-100 grid place-items-center">
    <div class="w-full max-w-md p-6 bg-white shadow-md rounded">
        <h1 class="text-2xl font-bold mb-6 text-center">Course App</h1>
        <h1 class="text-1xl font-bold mb-6 text-center">Registrarse</h1>
        <form wire:submit.prevent="register" class="grid grid-cols-1 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input
                    id="name"
                    type="text"
                    wire:model="name"
                    class="mt-1 w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                />
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    class="mt-1 w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                />
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    wire:model="password"
                    class="mt-1 w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                />
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input
                    id="phone"
                    type="tel"
                    wire:model="phone"
                    class="mt-1 w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                />
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


            <button
                type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Registrarse
            </button>

            @if (session()->has('message'))
                <div class="mt-4 text-green-600 text-sm text-center">
                    {{ session('message') }}
                </div>
            @endif
        </form>
         <div class="mt-4 text-center">
            <span class="text-sm">Ya tienes cuenta? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inicia sesión</a></span>
        </div>
    </div>
</div>
