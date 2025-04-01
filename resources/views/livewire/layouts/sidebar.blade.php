<aside @toggle-sidebar.window="isSidebarVisible = !isSidebarVisible"
    :class="{ 'flex': isSidebarVisible, 'hidden lg:flex': !isSidebarVisible }"
    class="bg-primaryCustom w-60 h-full flex-col transition-all duration-300 flex flex-col justify-between">
    <nav class="flex-1 pb-3 text-md">
        <ul class="space-y-2">
            @foreach ($links as $link)
                @if ($link['role'] === 'all' || (Auth::check() && Auth::user()->role === $link['role']))
                    <li>
                        <a href="{{ route($link['route']) }}"
                            class="flex items-center px-4 py-2 hover:bg-secondary  text-wrap
                    {{ Route::is($link['route']) ? 'bg-primary text-white' : 'text-white' }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
    {{-- <div class="pb-2">
        <a href="#" class="flex items-center text-white px-4 py-2  bg-red-400" wire:click.prevent="logout">
            <i class="fa-solid fa-right-from-bracket mr-2 fa-md"></i>
            Cerrar Sesión
        </a>
    </div> --}}
</aside>
