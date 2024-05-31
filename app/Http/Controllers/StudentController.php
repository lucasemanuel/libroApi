<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Spatie\QueryBuilder\QueryBuilder;

class StudentController extends Controller
{
    public function index()
    {
        $students = QueryBuilder::for(Student::class)
            ->allowedFilters(['full_name', 'email'])
            ->paginate();

        return StudentResource::collection($students);
    }

    public function store(StoreRequest $request)
    {
        $student = Student::create($request->safe()->all());

        return new StudentResource($student);
    }

    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    public function update(UpdateRequest $request, Student $student)
    {
        $student->update($request->safe()->all());

        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response(status: 204);
    }
}
