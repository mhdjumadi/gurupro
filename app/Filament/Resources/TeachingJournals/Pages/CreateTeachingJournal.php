<?php

namespace App\Filament\Resources\TeachingJournals\Pages;

use App\Filament\Resources\TeachingJournals\TeachingJournalResource;
use App\Models\Schedule;
use Filament\Resources\Pages\CreateRecord;

class CreateTeachingJournal extends CreateRecord
{
    protected static string $resource = TeachingJournalResource::class;

    public function mount(): void
    {
        parent::mount();

        $scheduleId = request()->query('schedule_id');

        if (!$scheduleId) {
            return;
        }

        $schedule = Schedule::find($scheduleId);

        if (!$schedule) {
            return;
        }

        $this->form->fill([
            'schedule_id' => $schedule->id,
            'start_time' => $schedule->start_time
                ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
                : null,
            'end_time' => $schedule->end_time
                ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
                : null,
            'date' => now()->format('Y-m-d'),
        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['teacher_id'] = auth()->id();

        return $data;
    }

    protected function afterCreate(): void
    {
        $journal = $this->record;

        $students = $journal->schedule
            ->class
            ->students()
            ->get();

        foreach ($students as $student) {
            $journal->attendances()->create([
                'student_id' => $student->id,
                'status' => 'hadir',
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl(
            'view',
            ['record' => $this->record]
        );
    }
}