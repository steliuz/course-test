<?php

namespace Tests\Unit;

use App\Models\Academy;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_course()
    {
        $service = new CourseService();
        $academyData = [
            'name' => 'Test Academy',
            'description' => 'Test Academy Description',
            'status' => 'active',
        ];

        $academy = Academy::create($academyData);

        $data = [
            'title' => 'Test Course',
            'description' => 'Test Description',
            'cost' => 100,
            'duration' => 10,
            'modality' => 'online',
            'status' => 'active',
            'academy_id' => $academy->id
        ];

        $service->createCourse($data);

        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
            'description' => 'Test Description',
            'cost' => 100,
            'duration' => 10,
            'modality' => 'online',
            'status' => 'active',
            'academy_id' => $academy->id
        ]);
    }

    public function test_update_course()
    {
        $academy = Academy::factory()->create();
        $course = Course::factory()->create(['academy_id' => $academy->id]);
        $service = new CourseService();
        $data = [
            'title' => 'Test Course Update',
            'description' => 'Test Description Update',
            'cost' => 200,
        ];

        $updatedCourse = $service->updateCourse($course->id, $data);
        $updatedCourse = Course::find($course->id);

        $this->assertEquals('Test Course Update', $updatedCourse->title);
        $this->assertEquals('Test Description Update', $updatedCourse->description);
        $this->assertEquals(200, $updatedCourse->cost);
    }

    public function test_get_all_courses()
    {
        $academy = Academy::factory()->create();
        Course::factory()->count(3)->create(['academy_id' => $academy->id]);
        $service = new CourseService();

        $courses = $service->getAllCourses();

        $this->assertCount(3, $courses);
    }

    public function test_delete_course()
    {
        $academy = Academy::factory()->create();
        $course = Course::factory()->create(['academy_id' => $academy->id]);
        $service = new CourseService();

        $response = $service->deleteCourse($course->id);

        $this->assertTrue($response['success']);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
