<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\CustomRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('students')->ignore($this->student)],
            'date_of_birth' => 'required|date',
            'gender' => 'string|in:male,female',
        ];
    }
}
