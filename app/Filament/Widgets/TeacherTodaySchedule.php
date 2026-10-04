<?php

namespace App\Filament\Widgets;

use App\Models\Schedule;
use App\Models\TeachingJournal;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class TeacherTodaySchedule extends Widget
{
    protected string $view = 'filament.widgets.teacher-today-schedule';

    public function getSchedules(): array
    {
        $today = now();

        return Schedule::query()
            ->with([
                'subject',
                'class',
            ])
            ->where('teacher_id', Auth::id())
            ->whereHas('class.students')
            ->where('day', $today->dayOfWeekIso)
            ->orderBy('start_time')
            ->get()
            ->map(function ($schedule) use ($today) {

                $journal = TeachingJournal::query()
                    ->where('teacher_id', Auth::id())
                    ->where('schedule_id', $schedule->id)
                    ->whereDate('date', $today)
                    ->first();

                return [
                    'id' => $schedule->id,
                    'start' => $schedule->start_time->format('H:i'),
                    'end' => $schedule->end_time->format('H:i'),
                    'subject' => $schedule->subject?->name ?? '-',
                    'class' => $schedule->class?->name ?? '-',
                    'room' => $schedule->class?->room ?? '-',

                    // Jurnal hari ini
                    'journal_id' => $journal?->id,
                    'has_journal' => $journal !== null,
                ];
            })
            ->toArray();
    }
}