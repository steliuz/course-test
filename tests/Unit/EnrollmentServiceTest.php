<?php

namespace Tests\Unit;

use App\Models\Academy;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\User;
use App\Services\EnrollmentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_enrollment_with_payment()
    {
        $father = User::factory()->create(['role' => 'father']);
        $student = Student::factory()->create(['father_id' => $father->id]);
        $course = Course::factory()->create(['academy_id' => Academy::factory()->create()->id]);

        $service = new EnrollmentService();

        $data = [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'paymentMethod' => 'credit_card',
        ];

        $enrollment = $service->createEnrollmentWithPayment($data);

        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'course_id' =>  $course->id,
            'status' => 'pending',
        ]);
        $this->assertDatabaseHas('payments', [
            'enrollment_id' => $enrollment->id,
            'payment_method' => 'credit_card',
            'status' => 'pending',
        ]);
    }

    public function test_get_all_enrollments()
    {
        $father = User::factory()->create(['role' => 'father']);
        $students = Student::factory()->count(3)->create(['father_id' => $father->id]);
        $courses = Course::factory()->count(3)->create(['academy_id' => Academy::factory()->create()->id]);

        foreach ($students as $student) {
            Enrollment::factory()->create([
                'student_id' => $student->id,
                'course_id' => $courses->random()->id,
            ]);
        }
        $service = new EnrollmentService();

        $enrollments = $service->getAllEnrollments();

        $this->assertCount(3, $enrollments);
    }
}
