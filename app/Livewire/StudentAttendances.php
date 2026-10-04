<?php

namespace App\Livewire;

use App\Models\JournalAttendance;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class StudentAttendances extends TableWidget
{
    public ?string $studentId = null;

    protected static ?string $heading = '📋 Rekap Presensi';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        $attendance = JournalAttendance::query()
            ->where('student_id', $this->studentId)
            ->get();

        return [
            'hadir' => $attendance->where('status', 'hadir')->count(),
            'sakit' => $attendance->where('status', 'sakit')->count(),
            'izin' => $attendance->where('status', 'izin')->count(),
            'alpa' => $attendance->where('status', 'alpa')->count(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder =>
                JournalAttendance::query()
                    ->where('student_id', $this->studentId)
                    ->with([
                        'teachingJournal.schedule.subject',
                    ])
            )
            ->columns([
                TextColumn::make('teachingJournal.date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make(
                    'teachingJournal.schedule.subject.name'
                )
                    ->label('Mata Pelajaran')
                    ->placeholder('-'),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(
                        fn($state) => match ($state) {
                            'hadir' => 'Hadir',
                            'sakit' => 'Sakit',
                            'izin' => 'Izin',
                            'alpa' => 'Alpa',
                            default => '-',
                        }
                    )
                    ->badge()
                    ->color(
                        fn($state) => match ($state) {
                            'hadir' => 'success',
                            'sakit' => 'warning',
                            'izin' => 'info',
                            'alpa' => 'danger',
                            default => 'gray',
                        }
                    ),

                TextColumn::make('note')
                    ->label('Catatan')
                    ->placeholder('-'),
            ])
            ->filters([
                SelectFilter::make('subject_id')
                    ->label('Mapel')
                    ->options(
                        fn() => JournalAttendance::query()
                            ->where('student_id', $this->studentId)
                            ->whereHas(
                                'teachingJournal.schedule.subject'
                            )
                            ->with(
                                'teachingJournal.schedule.subject'
                            )
                            ->get()
                            ->pluck(
                                'teachingJournal.schedule.subject.name',
                                'teachingJournal.schedule.subject.id'
                            )
                            ->filter()
                            ->unique()
                            ->sort()
                            ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->query(
                        function (Builder $query, array $data): Builder {
                            return $query->when(
                                $data['value'] ?? null,
                                fn(
                                Builder $query,
                                $subjectId
                            ) =>
                                $query->whereHas(
                                    'teachingJournal.schedule',
                                    fn(Builder $query) =>
                                    $query->where(
                                        'subject_id',
                                        $subjectId
                                    )
                                )
                            );
                        }
                    ),
            ])
            ->defaultSort(
                'teachingJournal.date',
                'desc'
            );
    }
}