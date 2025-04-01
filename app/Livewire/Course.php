<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Academy;
use App\Models\Course as CourseModel;
use App\Services\AcademyService;
use App\Services\CourseService; // Import the CourseService

class Course extends Component
{
    public $academies = [];
    public $courses = [];
    public $selectedItem = null;
    protected $academyService;
    protected $courseService;

    protected $listeners = [
        'academyUpdated' => 'loadAcademies',
        'courseUpdated' => 'loadCourses',
        'confirmDelete' => 'deleteAcademy',
        'confirmDeleteCourse' => 'deleteCourse',
        'editItem' => 'editAcademy',
        'editItemCourse' => 'editCourse',
    ];


    public function mount()
    {
        $this->academyService = new AcademyService();
        $this->courseService = new CourseService();
        $this->loadAcademies();
        $this->loadAllCourses();
    }

    public function loadAcademies()
    {
        $academyService = new AcademyService();
        $this->academies = $academyService->getAllAcademies();
    }

    public function loadAllCourses()
    {
        $this->courses = $this->courseService->getAllCourses();
    }


    public function editAcademy($id)

    {

        $this->selectedItem = Academy::find($id);
        if ($this->selectedItem) {
            $this->dispatch('dispatchEditAcademyModal', $this->selectedItem);
        } else {
            $this->dispatch('academyNotFound', ['message' => 'Academy not found.']);
        }
    }


    public function editCourse($id)
    {
        $this->selectedItem = CourseModel::find($id);
        if ($this->selectedItem) {
            $this->dispatch('dispatchEditCourseModal', $this->selectedItem);
        } else {
            $this->dispatch('courseNotFound', ['message' => 'Course not found.']);
        }
    }

    public function getCourse($id)
    {
        $this->selectedItem = $this->courseService->getCourse($id);
        if ($this->selectedItem) {
            $this->dispatch('dispatchEditCourseModal', $this->selectedItem);
        } else {
            $this->dispatch('courseNotFound', ['message' => 'Course not found.']);
        }
    }

    public function deleteAcademy($academyId, $name = null)
    {
        $academyService = new AcademyService();
        $result = $academyService->deleteAcademy($academyId);

        if ($result['success']) {
            $this->dispatch('academyDeleted', ['message' => $result['message']]);
            $this->dispatch('showToast', "Academia eliminada exitosamente", 'success', 3000);
        } else {
            $this->dispatch('academyNotFound', ['message' => $result['message']]);
        }

        $this->loadAcademies();
    }

    public function deleteCourse($id) {
        $result = $this->courseService->deleteCourse($id);
        if ($result['success']) {
            $this->dispatch('courseDeleted', ['message' => $result['message']]);
            $this->dispatch('showToast', "Curso eliminado exitosamente", 'success', 3000);
        } else {
            $this->dispatch('courseNotFound', ['message' => $result['message']]);
        }
        $this->loadAllCourses();
    }

    public function showCourses($academyId)
    {
        $this->courses = $this->courseService->getCoursesByAcademy($academyId);
    }

    public function render()
    {
        return view('livewire.course', [
            'academies' => $this->academies,
            'courses' => $this->courses,
        ]);
    }
}
