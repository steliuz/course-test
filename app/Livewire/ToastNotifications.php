<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ToastNotifications extends Component
{
    public $message = '';
    public $type = 'info';
    public $duration = 3000;
    public $isVisible = false;

    protected $listeners = ['showToast'];

    public function showToast($message, $type = 'info', $duration = 3000)
    {
        $this->message = $message;
        $this->type = $type;
        $this->duration = $duration;

        Log::info('Toast message:', [
            'message' => $message,
            'type' => $type,
            'duration' => $duration,
        ]);

        $this->dispatch('toast-show', message: $this->message, type: $this->type, duration: $this->duration);
        $this->isVisible = true;
    }

    public function hideToast()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        return view('livewire.toast-notifications');
    }
}
