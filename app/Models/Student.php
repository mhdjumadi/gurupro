<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'class_id',
        'nisn',
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'phone',
        'address',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(JournalAttendance::class, 'student_id');
    }

    public function journalAssessments()
    {
        return $this->hasMany(JournalAssessment::class);
    }

    public function journalAttendances()
    {
        return $this->hasMany(JournalAttendance::class);
    }
}
