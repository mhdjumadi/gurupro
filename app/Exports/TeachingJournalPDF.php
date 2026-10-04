<?php

namespace App\Exports;

use App\Models\TeachingJournal;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;

class TeachingJournalPdf
{
    public function download(array $filters)
    {
        $query = TeachingJournal::query()
            ->with([
                'teacher',
                'schedule.class',
                'schedule.subject',
                'attendances',
            ])
            ->where('teacher_id', auth()->id());

        // Semester
        if ($semester = data_get($filters, 'semester.value')) {
            $query->where('semester', $semester);
        }

        // Kelas
        if ($classId = data_get($filters, 'class_id.value')) {
            $query->whereHas('schedule', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            });
        }

        // Mata Pelajaran
        if ($subjectId = data_get($filters, 'subject_id.value')) {
            $query->whereHas('schedule', function ($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            });
        }

        // Rentang tanggal
        $fromDate = data_get($filters, 'date_range.date_from');
        $toDate = data_get($filters, 'date_range.date_until');

        if ($fromDate) {
            $query->whereDate('date', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('date', '<=', $toDate);
        }

        $journals = $query
            ->orderBy('date')
            ->get();

        if ($journals->isEmpty()) {
            Notification::make()
                ->title('Data tidak ditemukan')
                ->body('Tidak ada jurnal yang sesuai dengan filter yang dipilih.')
                ->warning()
                ->send();

            return;
        }

        $firstJournal = $journals->first();

        $pdf = Pdf::loadView('pdf.teaching-journal', [
            'journals' => $journals,

            'teacher' => $firstJournal->teacher->name,

            'nip' => $firstJournal->teacher->nip,

            'school' => $firstJournal->teacher->school,

            'class' => $journals
                ->pluck('schedule.class.name')
                ->filter()
                ->unique()
                ->implode(', '),

            'subject' => $journals
                ->pluck('schedule.subject.name')
                ->filter()
                ->unique()
                ->implode(', '),

            'semester' => $journals
                ->pluck('semester')
                ->filter()
                ->unique()
                ->implode(', '),

            'academicYear' => $journals
                ->pluck('schedule.class.academic_year')
                ->filter()
                ->unique()
                ->implode(', '),

            'room' => $journals
                ->pluck('schedule.class.room')
                ->filter()
                ->unique()
                ->implode(', '),
        ]);

        $pdf->setPaper('a4', 'landscape');

        $filename = 'jurnal-' .
            str($firstJournal->schedule->class->name)->slug() .
            '-' .
            str($firstJournal->schedule->subject->name)->slug() .
            '-' .
            $firstJournal->semester .
            '-' .
            ($fromDate ?: 'awal') .
            '-sampai-' .
            ($toDate ?: 'akhir') .
            '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $filename);
    }
}