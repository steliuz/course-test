<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function createCourse(array $data)
    {
        return Course::create($data);
    }

    public function updateCourse($id, array $data)
    {
        $course = Course::find($id);
        if ($course) {
            $course->update($data);
        }
        return $course;
    }

    public function getCourse($id)
    {
        return Course::find($id);
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return ['success' => true, 'message' => 'Curso eliminado correctamente'];
        }
        return ['success' => false, 'message' => 'Curso no encontrado'];
    }

    public function getAllCourses()
    {
        return Course::all();
    }

    public function getCoursesByAcademy($academyId)
    {
        return Course::where('academy_id', $academyId)->get();
    }

    public function getCoursesWithAcademies()
    {
        return Course::with('academy')->get()->toArray();
    }
}
