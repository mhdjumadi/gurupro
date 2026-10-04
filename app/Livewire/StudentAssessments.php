<?php

namespace App\Livewire;

use App\Models\JournalAssessment;
use App\Models\Subject;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class StudentAssessments extends TableWidget
{
    public ?string $studentId = null;

    protected static ?string $heading = '📊 Rekap Nilai';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => JournalAssessment::query()
                    ->where(
                        'student_id',
                        $this->studentId
                    )
                    ->with([
                        'teachingJournal.schedule.subject',
                    ])
            )
            ->columns([

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->getStateUsing(
                        fn(JournalAssessment $record) =>
                        $record->teachingJournal?->date
                        ? \Carbon\Carbon::parse(
                            $record->teachingJournal->date
                        )->format('d M Y')
                        : '-'
                    )
                    ->sortable(),

                TextColumn::make('subject')
                    ->label('Mapel')
                    ->getStateUsing(
                        fn(JournalAssessment $record) =>
                        $record
                            ->teachingJournal
                            ?->schedule
                            ?->subject
                                ?->name ?? '-'
                    )
                    ->weight('bold'),

                TextColumn::make('assessment')
                    ->label('Penilaian')
                    ->getStateUsing(
                        fn(JournalAssessment $record) =>
                        $record->name
                    ),

                TextColumn::make('score')
                    ->label('Nilai')
                    ->alignCenter()
                    ->badge()
                    ->placeholder('-')
                    ->color(function ($state) {

                        if ($state === null) {
                            return 'gray';
                        }

                        return match (true) {
                            (float) $state >= 90 => 'success',
                            (float) $state >= 75 => 'info',
                            (float) $state >= 60 => 'warning',
                            default => 'danger',
                        };
                    })
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('subject_id')
                    ->label('Mapel')
                    ->options(
                        fn() => JournalAssessment::query()
                            ->where('student_id', $this->studentId)
                            ->whereHas(
                                'teachingJournal.schedule.subject'
                            )
                            ->with('teachingJournal.schedule.subject')
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
                                fn(Builder $query, $subjectId) =>
                                $query->whereHas(
                                    'teachingJournal.schedule',
                                    fn(Builder $query) =>
                                    $query->where('subject_id', $subjectId)
                                )
                            );
                        }
                    ),
            ])
            ->defaultSort(
                'teaching_journal_id',
                'asc'
            );
    }
}