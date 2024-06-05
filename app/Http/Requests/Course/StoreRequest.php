<?php

namespace App\Http\Requests\Course;

use App\Http\Requests\CustomRequest;

class StoreRequest extends CustomRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
