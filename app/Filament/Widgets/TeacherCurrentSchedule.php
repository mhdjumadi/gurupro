<?php

namespace App\Filament\Widgets;

use App\Models\Schedule;
use App\Models\TeachingJournal;
use Carbon\Carbon;
use Filament\Widgets\Widget;

class TeacherCurrentSchedule extends Widget
{
    protected string $view = 'filament.widgets.teacher-current-schedule';

    public function getCurrentSchedule(): ?Schedule
    {
        $now = Carbon::now();

        return Schedule::query()
            ->where('teacher_id', auth()->id())
            ->whereHas('class.students')
            ->where('day', $now->dayOfWeekIso)
            ->whereTime('start_time', '<=', $now->format('H:i:s'))
            ->whereTime('end_time', '>=', $now->format('H:i:s'))
            ->with([
                'class',
                'subject',
            ])
            ->first();
    }


    public function hasJournal(Schedule $schedule): bool
    {
        return TeachingJournal::query()
            ->where('teacher_id', auth()->id())
            ->where('schedule_id', $schedule->id)
            ->whereDate('date', today())
            ->exists();
    }

}
