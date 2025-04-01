<div 
    x-data="{ 
        isVisible: @entangle('isVisible'), 
        message: '', 
        type: '' 
    }" 
    x-show="isVisible" 
    x-init="
        window.addEventListener('toast-show', event => {
            message = event.detail.message;
            type = event.detail.type;
            isVisible = true;
            setTimeout(() => isVisible = false, event.detail.duration);
        });
    "
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-4 right-4 p-4 rounded shadow-lg text-white z-100"
    :class="{
        'bg-green-400': type === 'success',
        'bg-red-400': type === 'error',
        'bg-blue-400': type === 'info'
    }"
    style="z-index: 9999;display: none;"
>
    <span x-text="message"></span>
</div>
