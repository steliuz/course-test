<?php

namespace App\Livewire;

use App\Models\Academy;
use Livewire\Component;
use App\Models\Course as CourseModel;
use App\Services\CourseService;

class CoursesList extends Component
{


    public $academies = [];
    public $courses = [];

    public function mount() 
    {
        $courseService = new CourseService();
        $this->courses = $courseService->getCoursesWithAcademies();
    }

    public function courseBuy($courseId)
    {
        $course = CourseModel::find($courseId);
        if ($course) {
            $this->dispatch('openModalBuy', $course);

        } else {
            session()->flash('error', 'Course not found.');
        }
    }


    public function render()
    {
        return view('livewire.courses-list');
    }
}