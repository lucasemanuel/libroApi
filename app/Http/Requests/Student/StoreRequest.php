<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\CustomRequest;

class StoreRequest extends CustomRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date|before:' . date('Y') - 6 . date('-m-d'),
            'gender' => 'string|in:male,female',
        ];
    }
}
