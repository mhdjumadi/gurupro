<?php

namespace App\Livewire;

use App\Exports\StudentAssessmentExport;
use App\Models\JournalAssessment;
use App\Models\Student;
use App\Models\TeachingJournal;
use App\Support\DateFormatter;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class StudentAssessmentReports extends TableWidget
{
    public ?string $classId = null;

    public ?string $subjectId = null;

    protected static ?string $heading = 'Laporan Penilaian Siswa';

    protected int|string|array $columnSpan = 'full';

    protected function getJournals()
    {
        return TeachingJournal::query()
            ->whereHas(
                'schedule',
                function (Builder $query) {
                    $query
                        ->where('class_id', $this->classId)
                        ->where('subject_id', $this->subjectId);
                }
            )
            ->with('assessments')
            ->orderBy('date')
            ->orderBy('id')
            ->get();
    }

    protected function getAssessmentColumns(): array
    {
        $columns = [];

        foreach ($this->getJournals() as $journal) {
            $dateLabel = DateFormatter::indonesia(
                $journal->date,
                'd M Y'
            );

            foreach ($journal->assessments->unique('name') as $assessment) {
                $journalId = $journal->id;
                $assessmentName = $assessment->name;

                $columns[] = TextColumn::make(
                    'assessment_' . $journalId . '_' . md5($assessmentName)
                )
                    ->label($assessmentName . ' • ' . $dateLabel)
                    ->getStateUsing(
                        function (Student $record) use ($journalId, $assessmentName) {
                            return JournalAssessment::query()
                                ->where('student_id', $record->id)
                                ->where('teaching_journal_id', $journalId)
                                ->where('name', $assessmentName)
                                ->value('score') ?? '-';
                        }
                    )
                    ->alignCenter()
                    ->badge()
                    ->color(
                        fn($state) => is_numeric($state)
                        ? match (true) {
                            $state >= 90 => 'success',
                            $state >= 75 => 'info',
                            $state >= 60 => 'warning',
                            default => 'danger',
                        }
                        : 'gray'
                    );
            }
        }

        return $columns;
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

                ...$this->getAssessmentColumns(),
            ])
            ->headerActions([
                Action::make('exportNilai')
                    ->label('Export Nilai')
                    ->icon('heroicon-o-document-chart-bar')
                    ->action(
                        fn() => Excel::download(
                            new StudentAssessmentExport(
                                $this->classId,
                                $this->subjectId
                            ),
                            'nilai-' . now()->format('Y-m-d') . '.xlsx'
                        )
                    ),
            ])
            ->defaultSort('name');
    }
}