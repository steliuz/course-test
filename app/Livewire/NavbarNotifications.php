<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\MessageService;
use Illuminate\Support\Facades\Log;

class NavbarNotifications extends Component
{
    public $messages = [];
    public $loading = true;

    protected $messageService;

    public function mount()
    {
        $this->messageService = new MessageService();
        $this->fetchMessages();
    }

    public function fetchMessages()
    {
        $this->loading = true; 
        $this->messages = $this->messageService->getUserMessages(auth()->user())->toArray();
        Log::info('Fetched messages for user: ', ['user_id' => auth()->user()->id, 'messages' => $this->messages]);
        $this->loading = false; 
    }

    public function render()
    {
        return view('livewire.navbar-notifications');
    }

}
