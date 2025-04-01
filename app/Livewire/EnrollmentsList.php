<?php

namespace App\Livewire;

use App\Services\EnrollmentService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EnrollmentsList extends Component
{
    public $enrollments;
    public $isPaymentModalOpen = false;
    public $paymentDetails = [];
    public $selectedEnrollment;
    public string $confirmAction = '';

    protected $enrollmentService;

    public function mount()
    {
        $this->enrollmentService = new EnrollmentService();
        $this->enrollments = $this->enrollmentService->getAllEnrollments();
    }

    public function openPaymentModal($enrollmentId)
    {
        $this->enrollmentService = new EnrollmentService();
        $this->selectedEnrollment = collect($this->enrollments)->firstWhere('id', $enrollmentId);
        $this->paymentDetails = $this->enrollmentService->getPaymentDetails($enrollmentId);
        $this->isPaymentModalOpen = true;
    }

    public function closePaymentModal()
    {
        $this->isPaymentModalOpen = false;
        $this->paymentDetails = [];
    }

    public function updatePaymentStatus($status)
    {
        $this->enrollmentService = new EnrollmentService();
        $this->enrollmentService->updatePaymentAndEnrollmentStatus($this->paymentDetails['id'], $status);

        if ($status === 'accepted') {
            $this->dispatch('showToast', 'Pago aceptado correctamente', 'success', 3000);
        } elseif ($status === 'rejected') {
            $this->dispatch('showToast', 'Pago rechazado correctamente', 'error', 3000);
        }

        $this->closePaymentModal();
        $this->enrollments = $this->enrollmentService->getAllEnrollments();
        $this->confirmAction = '';
    }

    public function startAcceptPayment()
    {
        $this->confirmAction = 'accept';
    }

    public function startRejectPayment()
    {
        $this->confirmAction = 'reject';
    }

    public function cancelConfirmation()
    {
        $this->confirmAction = '';
    }

    public function render()
    {
        return view('livewire.enrollments-list', [
            'enrollments' => $this->enrollments,
        ]);
    }
}
