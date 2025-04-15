<?php

namespace App\Livewire\General;

use Livewire\Component;
use App\Services\MessageService;
use App\Services\CourseService;
use Illuminate\Support\Facades\Log;
use App\Livewire\ToastNotifications;
use Carbon\Carbon;

class Messages extends Component
{
    public $messages = [];
    public $isOpen = false;
    public $title, $content, $type = 'Todos', $course_id, $age;
    public $messageId = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'type' => 'required|string|in:Todos,Curso,Edad',
        'course_id' => 'nullable|exists:courses,id',
        'age' => 'nullable|integer|min:1',
    ];

    public function mount(MessageService $messageService)
    {
        $this->messages = $messageService->getAllMessages();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isOpen = true;
        $this->type = 'Todos';
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function saveMessage()
    {
        $messageService = new MessageService();

        $this->course_id = $this->course_id ? (int) $this->course_id : null;
        $this->age = $this->age ? (int) $this->age : null;

        $this->validate();

        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'type' => $this->type,
            'course_id' => $this->type === 'Curso' ? $this->course_id : null,
            'age' => $this->type === 'Edad' ? $this->age : null,
        ];

        $messageService->createMessage($data);

        $this->messages = $messageService->getAllMessages();
        $this->closeModal();

        $this->dispatch('showToast', 'Mensaje enviado con exito', 'success');
    }

    public function resendMessage($id)
    {
        $messageService = new MessageService();
        $messageService->resendMessage($id);

        $this->messages = $messageService->getAllMessages();

        $this->dispatch('showToast', 'Mensaje reenviado con éxito', 'success', 4000);
    }

    public function formatDate($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i');
    }

    private function resetForm()
    {
        $this->title = '';
        $this->content = '';
        $this->type = '';
        $this->course_id = null;
        $this->age = null;
    }

    public function render(CourseService $courseService)
    {
        return view('livewire.general.messages', [
            'messages' => $this->messages,
            'courses' => $courseService->getAllCourses(),
        ]);
    }
}
