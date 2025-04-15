<?php

namespace App\Services;

use App\Models\Academy;

class AcademyService
{
    public function createAcademy($data)
    {
        return Academy::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
    }

    public function updateAcademy($id, $data)
    {
        $academy = Academy::find($id);
        if ($academy) {
            $academy->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'status' => $data['status'],
            ]);
            return $academy;
        }

        return null;
    }

    public function getAllAcademies()
    {
        return Academy::with('courses')->get();
    }

    public function deleteAcademy($id)
    {
        $academy = Academy::find($id);
        if ($academy) {
            $academy->delete();
            return ['success' => true, 'message' => "Academy '{$academy->name}' deleted successfully."];
        }

        return ['success' => false, 'message' => 'Academy not found.'];
    }
}
