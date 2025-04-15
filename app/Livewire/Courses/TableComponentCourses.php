<?php

namespace App\Livewire\Courses;

use Illuminate\Support\Facades\Log;
use App\Models\Academy;
use App\Models\Course;
use Livewire\Component;

class TableComponentCourses extends Component
{
    public $items;
    public $type;

    protected $listeners = [
        'deleteConfirmed' => 'confirmDelete',
    ];
    public function mount($type)
    {
        $this->type = $type;
        if (empty($this->items)) {
            if ($this->type === 'academy') {
                $this->items = Academy::withCount('courses')->get();
            } elseif ($this->type === 'course') {
                $this->items = Course::with('academy')->get();
            }
        }
    }

    public function confirmDelete($id, $type)
    {
        if ($type === 'academy') {

            $this->dispatch('confirmDelete', $id);
        } else {
            $this->dispatch('confirmDeleteCourse', $id);
        }
    }

    public function showCourses($id)
    {
        $this->dispatch('showCourses', $id);
    }



    public function render()
    {
        return view('livewire.courses.table-component-courses');
    }
}
