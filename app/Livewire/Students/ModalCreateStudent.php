<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ModalCreateStudent extends Component
{
    public $isOpen = false;
    public $modeEdit = false;
    public $father_auth_id = null;
    public $data = [
        'first_name' => '',
        'last_name' => '',
        'date_of_birth' => '',
        'id' => null,
        'father_id' => null,
    ];

    protected $rules = [
        'data.first_name' => 'required|string|max:255',
        'data.last_name' => 'required|string|max:255',
        'data.date_of_birth' => 'required|string|max:255',
    ];
    protected $listeners = ['openModalStudent' => 'showModal','dispatchEditStudentModal' => 'openEditModal'];


    public function showModal()
    {
        $this->isOpen = true;
        $this->data['father_id'] = $this->father_auth_id;

    }

    public function openEditModal($student)
    {
        $this->isOpen = true;
        $this->modeEdit = true;
        $selectedItem = Student::find($student['id']);
        Log::info('Selected item for student edit:', ['item' => $selectedItem]);

        $this->data = [
            'first_name' => $selectedItem['first_name'],
            'last_name' => $selectedItem['last_name'],
            'date_of_birth' => $selectedItem['date_of_birth'],
            'father_id' => $this->father_auth_id,
            'id' => $selectedItem['id'],
        ];
    }


    public function saveStudent()
    {
        $this->validate();

         // Log the data being saved

        if ($this->modeEdit) {
            $student = Student::find($this->data['id']);
            if ($student) {
                $student->update([
                    'first_name' => $this->data['first_name'],
                    'last_name' => $this->data['last_name'],
                    'date_of_birth' => $this->data['date_of_birth'],
                ]);
            }
        } else {
            Log::info('Creating new student', $this->data);
            Student::create([
                'first_name' => $this->data['first_name'],
                'last_name' => $this->data['last_name'],
                'date_of_birth' => $this->data['date_of_birth'],
                'father_id' => $this->data['father_id'],
            ]);
        }

        $this->dispatch('studentLoaded');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->modeEdit = false;
        $this->data = [
            'first_name' => '',
            'last_name' => '',
            'date_of_birth' => '',
            'id' => null,
            'father_id' => null,
        ];
        $this->isOpen = false;
    }

    public function render()
    {
        $this->father_auth_id = auth()->user()->id;
        return view('livewire.students.modal-create-student');
    }
}
