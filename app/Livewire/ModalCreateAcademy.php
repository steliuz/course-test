<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AcademyService;


class ModalCreateAcademy extends Component
{
    public $isOpen = false;
    public $modeEdit = false, $name, $description, $status = 'active', $id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'status' => 'required|in:active,inactive',
    ];

    protected $listeners = [
        'dispatchCreateAcademyModal' => 'openModal',
        'dispatchEditAcademyModal' => 'openEditModal',
    ];


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function openEditModal($selectedItem)
    {
        $this->isOpen = true;
        $this->modeEdit = true;
        $this->name = $selectedItem['name'];
        $this->id = $selectedItem['id'];
        $this->description = $selectedItem['description'];
        $this->status = $selectedItem['status'];
    }

    public function closeModal()
    {
        $this->reset(['isOpen', 'name', 'description']);
    }

    public function saveAcademy()
    {
        $this->validate();

        $academyService = new AcademyService();

        if (!$this->modeEdit) {
            $academyService->createAcademy([
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status,
            ]);
            $this->dispatch('showToast', 'Academia Creada Correctamente', 'success', 3000);
            $this->dispatch('academyUpdated');
            $this->closeModal();
            return;
        }

        $academyService->updateAcademy($this->id, [
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $this->dispatch('showToast', 'Academia Editada Correctamente', 'success', 3000);
        $this->dispatch('academyUpdated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modal-create-academy');
    }
}
