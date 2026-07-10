<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';
    
    protected $fillable = [
        'student_id',
        'course_id',
        'academic_year',
        'semester_type',
        'status',
        'grade',
        'approved_by',
        'approved_at',
        'graded_by',
        'graded_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'grade' => 'integer'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function grader()
    {
        return $this->belongsTo(Lecturer::class, 'graded_by');
    }

    public function getGradeLetterAttribute(): string
    {
        if ($this->grade === null) {
            return '-';
        }

        return match (true) {
            $this->grade >= 85 => 'A',
            $this->grade >= 70 => 'B',
            $this->grade >= 55 => 'C',
            $this->grade >= 40 => 'D',
            default => 'E',
        };
    }

    public function getGradePointAttribute(): int
    {
        return match ($this->grade_letter) {
            'A' => 4,
            'B' => 3,
            'C' => 2,
            'D' => 1,
            default => 0,
        };
    }
}
