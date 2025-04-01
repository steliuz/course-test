<div>
    <h1>Contador</h1>
    <div class="flex justify-center">
        <button wire:click="increment" class="bg-blue-500 text-white px-4 py-2 rounded">Incrementar</button>
        <button wire:click="decrement" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Decrementar</button>
    </div>
    <div class="text-center mt-4">
        <h2 class="text-xl">Contador: {{ $count }}</h2>
    </div>
</div>
