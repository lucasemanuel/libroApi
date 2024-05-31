<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'enrollment_date', 'status'];

    protected static function booted(): void
    {
        static::creating(function (Enrollment $enrollment) {
            $now = now();
            $enrollment->enrollment_date = $now;
            $enrollment->number = $now->getTimestampMs();
        });
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
