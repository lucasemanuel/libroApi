<?php

namespace App\Http\Controllers;

use App\Enums\EnrollmentStatus;
use App\Enums\Gender;
use App\Http\Requests\Enrollment\StoreRequest;
use App\Http\Requests\Enrollment\UpdateRequest;
use App\Http\Resources\EnrollmentResource;
use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->paginate();

        return EnrollmentResource::collection($enrollments);
    }

    public function store(StoreRequest $request)
    {
        $enrollment = Enrollment::create([
             ...$request->safe()->all(),
            'status' => EnrollmentStatus::Actived,
        ]);

        return new EnrollmentResource($enrollment);
    }

    public function show(Enrollment $enrollment)
    {
        return new EnrollmentResource($enrollment);
    }

    public function update(UpdateRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->safe()->all());

        return new EnrollmentResource($enrollment);
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return response(status: 204);
    }

    public function statistics()
    {
        $statistics = collect([
            'less_than_15' => collect([]),
            'between_15_and_18' => collect([]),
            'between_19_and_24' => collect([]),
            'between_25_and_30' => collect([]),
            'more_than_30' => collect([]),
        ]);

        Course::with(['enrollments.student'])->get()->each(function (Course $course, int $key) use ($statistics) {
            foreach ($this->getRangesFromStatistics() as $range) {
                $query = $this->applyQueryByRange($course->enrollments, $range);
                $males = $query->where('student.gender', Gender::Male->value)->count();
                $females = $query->where('student.gender', Gender::Female->value)->count();

                if ($males || $females) {
                    $statistics->get($range)->push([
                        'course' => $course->name,
                        'females' => $females,
                        'males' => $males,
                    ]);
                }
            }
        });

        return $statistics;
    }

    private function getRangesFromStatistics(): array
    {
        return [
            'less_than_15',
            'between_15_and_18',
            'between_19_and_24',
            'between_25_and_30',
            'more_than_30',
        ];
    }

    private function applyQueryByRange($query, string $range)
    {
        return match ($range) {
            'less_than_15' => $query->where('student.age', '<=', 14),
            'between_15_and_18' => $query->whereBetween('student.age', [15, 18]),
            'between_19_and_24' => $query->whereBetween('student.age', [19, 24]),
            'between_25_and_30' => $query->whereBetween('student.age', [25, 30]),
            'more_than_30' => $query->where('student.age', '>=', 31)
        };
    }
}
