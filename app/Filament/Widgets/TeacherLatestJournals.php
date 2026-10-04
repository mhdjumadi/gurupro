<?php

namespace App\Filament\Widgets;

use App\Models\TeachingJournal;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class TeacherLatestJournals extends Widget
{
    protected string $view = 'filament.widgets.teacher-latest-journals';

    public function getJournals()
    {
        $user = Auth::user();

        if (!$user) {
            return collect();
        }

        return TeachingJournal::query()
            ->with([
                'schedule.subject',
                'schedule.class',
            ])
            ->where('teacher_id', $user->id)
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->limit(5)
            ->get();
    }
}