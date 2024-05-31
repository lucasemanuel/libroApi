<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'email', 'date_of_birth', 'gender'];

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => now()->parse($attributes['date_of_birth'])->age
        );
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
