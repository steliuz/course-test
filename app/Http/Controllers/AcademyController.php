<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademyRequest;
use Illuminate\Http\Request;
use App\Services\AcademyService;
use App\Models\Academy;

class AcademyController extends Controller
{
    protected $academyService;

    public function __construct(AcademyService $academyService)
    {
        $this->academyService = $academyService;
    }

    public function index()
    {
        $academies = $this->academyService->getAllAcademies();
        return view('course', compact('academies'));
    }

    public function store(AcademyRequest $request)
    {
        $validated = $request->validated();

        $academy = $this->academyService->createAcademy($validated);

        return response()->json(['message' => 'Academy created successfully.', 'data' => $academy], 201);
    }

    public function update(AcademyRequest $request, $id)
    {
        $validated = $request->validated();

        $updatedAcademy = $this->academyService->updateAcademy($id, $validated);

        if ($updatedAcademy) {
            return response()->json(['message' => 'Academy updated successfully.', 'data' => $updatedAcademy], 200);
        }

        return response()->json(['message' => 'Academy not found.'], 404);
    }

    public function destroy($id)
    {
        $result = $this->academyService->deleteAcademy($id);

        if ($result['success']) {
            return response()->json(['message' => $result['message']], 200);
        }

        return response()->json(['message' => $result['message']], 404);
    }
}
