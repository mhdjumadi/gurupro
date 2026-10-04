<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JournalAttendance extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'teaching_journal_id',
        'student_id',
        'status',
        'note',
    ];

    public function teachingJournal()
    {
        return $this->belongsTo(
            TeachingJournal::class,
            'teaching_journal_id'
        );
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}
