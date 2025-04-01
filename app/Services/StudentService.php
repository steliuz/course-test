<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    public function getStudentsByFather($fatherId)
    {
        return Student::with('father')->where('father_id', $fatherId)->get();
    }

    public function findStudent($id)
    {
        return Student::find($id);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return true;
        }
        return false;
    }
}
