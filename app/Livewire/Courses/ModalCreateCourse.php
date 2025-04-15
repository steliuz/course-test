<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;
use App\Models\Academy;
use App\Services\CourseService; // Import the new service

class ModalCreateCourse extends Component
{
    public $isOpen = false;
    public $modeEdit = false;
    public $title, $description, $cost, $duration, $modality, $status = 'active', $academy , $id;
    public $academies = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'cost' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'modality' => 'required|in:Online,Presencial',
        'status' => 'required|in:active,inactive',
        'academy' => 'required|exists:academies,id',
    ];

    protected $listeners = ['dispatchCreateCourseModal' => 'openModal', 'dispatchEditCourseModal' => 'openEditModal'];

    public function openModal()
    {
        $this->reset(['title', 'description', 'cost', 'duration', 'modality', 'status', 'academy']);
        $this->isOpen = true;
    }
    public function openEditModal($selectedItem)
    {
        $this->isOpen = true;
        $this->modeEdit = true;
        $this->id = $selectedItem['id'];
        $this->title = $selectedItem['title'];
        $this->description = $selectedItem['description'];
        $this->cost = $selectedItem['cost'];
        $this->duration = $selectedItem['duration'];
        $this->modality = $selectedItem['modality'];
        $this->status = $selectedItem['status'];
        $this->academy = $selectedItem['academy_id'];
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function saveCourse()
    {
        $this->validate();

        $courseData = [
            'title' => $this->title,
            'description' => $this->description,
            'cost' => $this->cost,
            'duration' => $this->duration,
            'modality' => $this->modality,
            'status' => $this->status,
            'academy_id' => $this->academy,
        ];

        $courseService = new CourseService();

        if ($this->modeEdit) {
            $courseService->updateCourse($this->id, $courseData);
            $message = 'Curso Editado Correctamente';
        } else {
            $courseService->createCourse($courseData);
            $message = 'Curso Creado Correctamente';
        }

        $this->dispatch('showToast', $message, 'success', 3000);
        $this->dispatch('academyUpdated');
        $this->closeModal();
    }

    public function render()
    {
        $this->academies = Academy::all();
        return view('livewire.courses.modal-create-course');
    }
}
