<x-layouts.base>
    <div class="flex flex-col h-full" x-data="{ isSidebarVisible: false }">
        <livewire:layouts.navbar />
        <div class="flex h-full overflow-hidden">
            <livewire:layouts.sidebar />
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    <livewire:general.toast-notifications />
</x-layouts.base>
