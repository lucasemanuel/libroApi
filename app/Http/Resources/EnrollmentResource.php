<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student' => new StudentResource($this->student),
            'course' => new CourseResource($this->course),
            'enrollment_date' => $this->enrollment_date,
            'status' => $this->status,
        ];
    }
}
