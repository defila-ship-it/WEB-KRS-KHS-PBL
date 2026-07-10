<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'lecturer_id',
        'academic_year',
        'semester_type',
        'meeting_date',
        'week_number',
        'meeting_type',
        'meeting_method',
        'material',
    ];

    protected $casts = [
        'meeting_date' => 'date',
        'week_number' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
