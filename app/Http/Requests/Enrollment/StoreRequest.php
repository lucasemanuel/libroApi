<?php

namespace App\Http\Requests\Enrollment;

use App\Http\Requests\CustomRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomRequest
{
    public function rules(): array
    {
        return [
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('enrollments')->where(function ($query) {
                    return $query->where('student_id', $this->student_id)->where('course_id', $this->course_id);
                }),
            ],
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
