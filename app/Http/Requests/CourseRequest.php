<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'modality' => 'required|in:Online,Presencial',
            'status' => 'required|in:active,inactive',
            'academy_id' => 'required|exists:academies,id',
        ];
    }
}
