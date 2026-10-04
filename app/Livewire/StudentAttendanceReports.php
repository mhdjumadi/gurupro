<?php

namespace App\Livewire;

use App\Filament\Exports\StudentAttendanceExport;
use App\Models\JournalAttendance;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Actions\ExportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class StudentAttendanceReports extends TableWidget
{
    public ?string $classId = null;

    public ?string $subjectId = null;

    protected static ?string $heading = 'Laporan Presensi Siswa';

    protected int|string|array $columnSpan = 'full';

    protected function getAttendanceCount(
        Student $student,
        string $status
    ): int {
        return JournalAttendance::query()
            ->where('student_id', $student->id)
            ->where('status', $status)
            ->whereHas(
                'teachingJournal.schedule',
                function (Builder $query) {
                    $query
                        ->where('class_id', $this->classId)
                        ->where('subject_id', $this->subjectId);
                }
            )
            ->count();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder =>
                Student::query()
                    ->where('class_id', $this->classId)
            )
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex()
                    ->alignCenter(),

                TextColumn::make('name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('hadir')
                    ->label('Hadir')
                    ->getStateUsing(
                        fn(Student $record) =>
                        $this->getAttendanceCount($record, 'hadir')
                    )
                    ->alignCenter()
                    ->badge()
                    ->color('success'),

                TextColumn::make('sakit')
                    ->label('Sakit')
                    ->getStateUsing(
                        fn(Student $record) =>
                        $this->getAttendanceCount($record, 'sakit')
                    )
                    ->alignCenter()
                    ->badge()
                    ->color('warning'),

                TextColumn::make('izin')
                    ->label('Izin')
                    ->getStateUsing(
                        fn(Student $record) =>
                        $this->getAttendanceCount($record, 'izin')
                    )
                    ->alignCenter()
                    ->badge()
                    ->color('info'),

                TextColumn::make('alpa')
                    ->label('Alpa')
                    ->getStateUsing(
                        fn(Student $record) =>
                        $this->getAttendanceCount($record, 'alpa')
                    )
                    ->alignCenter()
                    ->badge()
                    ->color('danger'),
            ])
            ->headerActions([
                Action::make('exportPresensi')
                    ->label('Export Presensi')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(
                        fn() => Excel::download(
                            new \App\Exports\StudentAttendanceExport(
                                $this->classId,
                                $this->subjectId
                            ),
                            'presensi-' . now()->format('Y-m-d') . '.xlsx'
                        )
                    ),
            ])
            ->defaultSort('name')
            ->defaultSort('name');
    }
}