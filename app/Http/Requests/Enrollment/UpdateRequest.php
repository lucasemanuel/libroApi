<?php

namespace App\Http\Requests\Enrollment;

use App\Enums\EnrollmentStatus;
use App\Http\Requests\CustomRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::enum(EnrollmentStatus::class)],
        ];
    }
}
