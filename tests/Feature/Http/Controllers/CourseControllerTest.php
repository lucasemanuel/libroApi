<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\EnrollmentStatus;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_endpoint_delete_should_throw_an_error_when_try_delete_a_course_with_students(): void
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create();
        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => EnrollmentStatus::Actived,
        ]);

        $response = $this->delete("/api/courses/$course->id");
        $response->assertBadRequest();
    }
}
