<?php

namespace App\Livewire;

use App\Services\StudentService;
use Livewire\Component;

class StudentsPage extends Component
{
    public $students;
    protected $studentService;

    protected $listeners = [
        'studentLoaded' => 'loadStudents',
        'editItemStudent' => 'editStudent',
        'deleteConfirmed' => 'deleteStudent',
    ];

    public function __construct()
    {
        $this->studentService = new StudentService();
    }

    public function mount()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        $this->students = $this->studentService->getStudentsByFather(auth()->id());
    }

    public function editStudent($id)
    {
        $student = $this->studentService->findStudent($id);
        if ($student) {
            $this->dispatch('dispatchEditStudentModal', $student);
        } else {
            $this->dispatch('academyNotFound', ['message' => 'Academy not found.']);
        }
    }

    public function deleteStudent($id, $type)
    {
        $deleted = $this->studentService->deleteStudent($id);
        if ($deleted) {
            $this->loadStudents();
        } else {
            session()->flash('error', 'Student not found.');
        }
    }

    public function render()
    {
        return view('livewire.students-page');
    }
}
