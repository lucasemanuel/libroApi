<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate();

        return CourseResource::collection($courses);
    }

    public function store(StoreRequest $request)
    {
        $course = Course::create($request->safe()->all());

        return new CourseResource($course);
    }

    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function update(UpdateRequest $request, Course $course)
    {
        $course->update($request->safe()->all());

        return new CourseResource($course);
    }

    public function destroy(Course $course)
    {
        $hasEnrollments = $course->enrollments()->exists();
        abort_if($hasEnrollments, 400, 'Course has student enrolled.');

        $course->delete();

        return response(status: 204);
    }
}
