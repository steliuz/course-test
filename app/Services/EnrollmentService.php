<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    public function createEnrollmentWithPayment($data): Enrollment
    {
        return DB::transaction(function () use ($data) {
            $enrollment = Enrollment::create([
                'student_id' => $data['student_id'],
                'course_id' => $data['course_id'],
                'status' => 'pending',
            ]);

            Payment::create([
                'enrollment_id' => $enrollment->id,
                'cost' => $enrollment->course->cost,
                'payment_method' => $data['paymentMethod'],
                'status' => 'pending',
            ]);

            return $enrollment;
        });
    }

    public function getAllEnrollments()
    {
        return Enrollment::with(['student', 'course'])->get();
    }

    public function getPaymentDetails($enrollmentId)
    {
        return Payment::where('enrollment_id', $enrollmentId)->firstOrFail()->toArray();
    }

    public function updatePaymentAndEnrollmentStatus($paymentId, $status)
    {
        DB::transaction(function () use ($paymentId, $status) {
            $payment = Payment::findOrFail($paymentId);
            $payment->status = $status;
            $payment->save();

            $enrollment = $payment->enrollment;
            $enrollment->status = $status;
            $enrollment->save();
        });
    }
}
