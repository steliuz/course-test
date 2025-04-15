<?php

namespace App\Livewire\General;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ModaConfirmDelete extends Component
{

    public $show = false;
    public $title, $name, $type, $id;

    protected $listeners = [
        'showDeleteModal' => 'openModal',
        'hideDeleteModal' => 'closeModal',
    ];

    public function openModal($title, $type = null, $name = null, $id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type ?? 'default';
        $this->name = $name;
        $this->show = true;
    }

    public function hideDeleteModal()
    {
        $this->show = false;
    }
    public function deleteCancelled()
    {
        $this->hideDeleteModal();
    }
    public function deleteConfirmed()
    {
        $this->dispatch('deleteConfirmed', $this->id, $this->type);
        $this->hideDeleteModal();
    }

    public function render()
    {
        return view('livewire.general.modal-confirm-delete');
    }
}
