<?php

namespace Tests\Unit;

use App\Models\Academy;
use App\Services\AcademyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademyServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_academy()
    {
        $service = new AcademyService();
        $data = [
            'name' => 'Test Academy',
            'description' => 'Test Description',
            'status' => 'active',
        ];

        $academy = $service->createAcademy($data);

        $this->assertDatabaseHas('academies', [
            'name' => 'Test Academy',
            'description' => 'Test Description',
            'status' => 'active',
        ]);
    }

    public function test_update_academy()
    {
        $academy = Academy::factory()->create();
        $service = new AcademyService();
        $data = [
            'name' => 'Updated Academy',
            'description' => 'Updated Description',
            'status' => 'inactive',
        ];

        $updatedAcademy = $service->updateAcademy($academy->id, $data);

        $this->assertEquals('Updated Academy', $updatedAcademy->name);
        $this->assertEquals('Updated Description', $updatedAcademy->description);
        $this->assertEquals('inactive', $updatedAcademy->status);
    }

    public function test_get_all_academies()
    {
        Academy::factory()->count(3)->create();
        $service = new AcademyService();

        $academies = $service->getAllAcademies();

        $this->assertCount(3, $academies);
    }

    public function test_delete_academy()
    {
        $academy = Academy::factory()->create();
        $service = new AcademyService();

        $response = $service->deleteAcademy($academy->id);

        $this->assertTrue($response['success']);
        $this->assertDatabaseMissing('academies', ['id' => $academy->id]);
    }

    public function test_delete_nonexistent_academy()
    {
        $service = new AcademyService();

        $response = $service->deleteAcademy(9999);

        $this->assertFalse($response['success']);
        $this->assertEquals('Academy not found.', $response['message']);
    }
}
