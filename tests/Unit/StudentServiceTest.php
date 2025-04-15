<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Models\User;
use App\Services\StudentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_students_by_father()
    {
        $service = new StudentService();
        $fatherId = 1;

        $students = $service->getStudentsByFather($fatherId);

        $this->assertIsIterable($students);
    }

    public function test_find_student()
    {
        $father = User::factory()->create(['role' => 'father']);
        $student = Student::factory()->create(['father_id' => $father->id]);
        $service = new StudentService();

        $foundStudent = $service->findStudent($student->id);

        $this->assertEquals($student->id, $foundStudent->id);
    }

    public function test_delete_student()
    {
        $father = User::factory()->create(['role' => 'father']);
        $student = Student::factory()->create(['father_id' => $father->id]);
        $service = new StudentService();

        $result = $service->deleteStudent($student->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
