<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('students')->ignore($this->student)],
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female',
        ];
    }
}
