<?php

namespace App\Livewire;

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

        if ($this->type === 'academy') {
            $this->items = Academy::withCount('courses')->get();
        } elseif ($this->type === 'course') {
            $this->items = Course::with('academy')->get();
        }
    }

    public function confirmDelete($id, $type)
    {
        if($type === 'academy'){

            $this->dispatch('confirmDelete', $id);
        } else {
            $this->dispatch('confirmDeleteCourse', $id);
        }
    }

    public function render()
    {
        return view('livewire.table-component-courses');
    }
}
