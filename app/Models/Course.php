<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    
    protected $fillable = [
        'lecturer_id',
        'code',
        'name',
        'credits',
        'study_program',
        'semester',
        'semester_type',
        'schedule',
        'room',
    ];

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function meetings()
    {
        return $this->hasMany(CourseMeeting::class);
    }
}
