<?php

namespace App\Services;

use App\Models\Message;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class MessageService
{
    public function getAllMessages()
    {
        return Message::with('users')->get()->toArray();
    }

    public function createMessage($data)
    {
        $message = Message::create([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        if ($data['type'] === 'Todos') {
            $parentUsers = User::where('role', 'father')->get();

            foreach ($parentUsers as $user) {
                $message->users()->attach($user->id, [
                    'type' => $data['type'],
                    'course_id' => null,
                    'age' => null,
                ]);
            }
        } elseif ($data['type'] === 'Curso' && isset($data['course_id'])) {

            $enrollments = Enrollment::where('course_id', $data['course_id'])
                ->where('status', 'active')
                ->get();

                Log::info('Enrollments found: ', $enrollments->toArray());

            foreach ($enrollments as $enrollment) {
                $student = Student::find($enrollment->student_id);
                $father = $student->father;

                if ($father) {
                    $message->users()->attach($father->id, [
                        'type' => $data['type'],
                        'course_id' => $data['course_id'],
                        'age' => null,
                    ]);
                }
            }
        } elseif ($data['type'] === 'Edad') {
            $students = Student::whereYear('date_of_birth', '=', now()->subYears($data['age'])->year)->get();

            foreach ($students as $student) {
            $father = $student->father;

            if ($father) {
                $message->users()->attach($father->id, [
                'type' => $data['type'],
                'course_id' => null,
                'age' => $data['age'],
                ]);
            }
            }
        }

        return $message;
    }

    public function getUserMessages($user)
    {
        if ($user->role !== 'admin') {
            return $user->messages()
                ->withPivot(['type', 'course_id', 'age', 'created_at'])
                ->get();
        }

        return collect();
    }

    public function resendMessage($messageId)
    {
        $message = Message::findOrFail($messageId);
        Log::info('Resending message: ', $message->toArray());
        $messageUsers = $message->users()->withPivot(['type', 'course_id', 'age'])->get();
        Log::info('Users to resend message to: ', $messageUsers->toArray());
        foreach ($messageUsers as $user) {
            $message->users()->attach($user->id, [
                'type' => $user->pivot->type,
                'course_id' => $user->pivot->course_id,
                'age' => $user->pivot->age,
            ]);
        }

        return $message;
    }
}
