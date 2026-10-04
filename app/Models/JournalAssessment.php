<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JournalAssessment extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'teaching_journal_id',
        'student_id',
        'name',
        'score',
    ];

    protected $casts = [
        'score' => 'decimal:2',
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