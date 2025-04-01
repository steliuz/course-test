<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Services\EnrollmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    protected $enrollmentService;

    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }

    public function index(): View
    {
        $enrollments = $this->enrollmentService->getAllEnrollments();
        return view('livewire.enrollments-list', compact('enrollments'));
    }

    public function store(StoreEnrollmentRequest $request): JsonResponse
    {
        $enrollment = $this->enrollmentService->createEnrollmentWithPayment($request->validated());
        return response()->json(['message' => 'Enrollment and payment created successfully', 'data' => $enrollment], 201);
    }
}
