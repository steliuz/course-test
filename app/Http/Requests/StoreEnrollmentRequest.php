<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'payment_method' => 'required|in:cash,transfer',
        ];
    }
}
