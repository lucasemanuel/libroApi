<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\EnrollmentStatus;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EnrollmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_endpoint_statistics_payload_response(): void
    {
        $response = $this->getJson('/api/statistics/enrollments');
        $response->assertOk(200);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('less_than_15', [])
            ->where('between_15_and_18', [])
            ->where('between_19_and_24', [])
            ->where('between_25_and_30', [])
            ->where('more_than_30', [])
        );
    }

    public function test_endpoint_store_should_throw_an_error_when_try_re_enroll_in_same_course(): void
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create();
        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => EnrollmentStatus::Actived,
        ]);

        $response = $this->postJson('/api/enrollments', [
            'student_id' => $student->id,
            'course_id' => $course->id
        ]);
        $response->assertBadRequest();
    }
}
