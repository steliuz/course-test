<?php

namespace App\Livewire;

use App\Models\Student;
use App\Services\EnrollmentService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ModalBuyCourse extends Component
{
    public $course = null, $isOpen = false, $modeEdit = false, $student = null;
    public $paymentMethod;
    public $myStudents = [];


    protected $listeners = [
        'openModalBuy' => 'openModal',
        'closeModal' => 'closeModal',
    ];

    public function mount()
    {
        $this->paymentMethod = 'transfer';
    }

    public function openModal($course)
    {
        $this->course = $course;
        $this->getMyStudents(); // Cargar estudiantes al abrir el modal
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['course', 'isOpen', 'modeEdit']);
    }

    public function getMyStudents()
    {

        $this->myStudents = Student::where('father_id', auth()->id())->get();
        Log::info('My students', ['students' => $this->myStudents]);
    }

    public function registerEnrollment()
    {
        $this->validate([
            'paymentMethod' => 'required',
        ]);

        if (!$this->student) {
            $this->dispatch('showToast', 'Debe seleccionar un estudiante antes de confirmar la compra.', 'error', 3000);
            return;
        }

        try {
            $enrollmentService = new EnrollmentService();
            $enrollmentService->createEnrollmentWithPayment([
                'student_id' => $this->student,
                'course_id' => $this->course['id'],
                'paymentMethod' => $this->paymentMethod,
            ]);

            $this->dispatch('showToast', 'Matrícula y pago registrados exitosamente.', 'success', 3000);
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('showToast', 'Ocurrió un error al registrar la matrícula y el pago.', 'error', 3000);
            Log::error('Error registering enrollment and payment', ['error' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.modal-buy-course');
    }
}
