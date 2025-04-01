<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function store(CourseRequest $request): JsonResponse
    {
        $course = $this->courseService->createCourse($request->validated());
        return response()->json(['message' => 'Curso creado correctamente', 'data' => $course], 201);
    }

    public function update(CourseRequest $request, $id): JsonResponse
    {
        $course = $this->courseService->updateCourse($id, $request->validated());
        return response()->json(['message' => 'Curso actualizado correctamente', 'data' => $course], 200);
    }

    public function index(): JsonResponse
    {
        $courses = $this->courseService->getAllCourses();
        return response()->json(['data' => $courses], 200);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->courseService->deleteCourse($id);

        if ($result['success']) {
            return response()->json(['message' => $result['message']], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }
}
