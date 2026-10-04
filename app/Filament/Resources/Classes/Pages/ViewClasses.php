<?php

namespace App\Filament\Resources\Classes\Pages;

use App\Filament\Resources\Classes\ClassesResource;
use App\Livewire\ClassStudents;
use App\Livewire\StudentAssessmentReports;
use App\Livewire\StudentAttendanceReports;
use App\Models\JournalAssessment;
use App\Models\JournalAttendance;
use App\Models\Schedule;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\EmptyState;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ViewClasses extends ViewRecord
{
    protected static string $resource = ClassesResource::class;

    public function infolist(Schema $schema): Schema
    {
        return ClassesResource::infolist($schema);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function hasAssessmentData(): bool
    {
        return JournalAssessment::query()
            ->whereHas(
                'teachingJournal.schedule',
                fn(Builder $query) =>
                $query->where('class_id', $this->record->id)
            )
            ->exists();
    }

    protected function hasAttendanceData(): bool
    {
        return JournalAttendance::query()
            ->whereHas(
                'teachingJournal.schedule',
                fn(Builder $query) =>
                $query->where('class_id', $this->record->id)
            )
            ->exists();
    }

    protected function getClassSubjects(): array
    {
        return Schedule::query()
            ->where('class_id', $this->record->id)
            ->with('subject')
            ->get()
            ->filter(fn($schedule) => $schedule->subject)
            ->mapWithKeys(fn($schedule) => [
                $schedule->subject->id => $schedule->subject->name,
            ])
            ->unique()
            ->sort()
            ->toArray();
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            // Informasi kelas
            $this->getInfolistContentComponent(),

            // Detail kelas
            Tabs::make('Detail Kelas')
                ->tabs([
                    // Siswa
                    Tab::make('Siswa')
                        ->icon('heroicon-o-users')
                        ->schema([
                            Grid::make(1)
                                ->schema(
                                    fn(): array =>
                                    $this->getWidgetsSchemaComponents([
                                        ClassStudents::make([
                                            'classId' => $this->record->id,
                                        ]),
                                    ])
                                ),
                        ]),

                    // Presensi
                    Tab::make('Presensi')
                        ->icon('heroicon-o-calendar-days')
                        ->schema(
                            $this->hasAttendanceData()
                            ? [
                                Tabs::make('Mapel Presensi')
                                    ->tabs(
                                        collect($this->getClassSubjects())
                                            ->map(
                                                function ($subjectName, $subjectId) {
                                                    return Tab::make($subjectName)
                                                        ->schema([
                                                            Grid::make(1)
                                                                ->schema(
                                                                    fn(): array =>
                                                                    $this->getWidgetsSchemaComponents([
                                                                        StudentAttendanceReports::make([
                                                                            'classId' => $this->record->id,
                                                                            'subjectId' => $subjectId,
                                                                        ]),
                                                                    ])
                                                                ),
                                                        ]);
                                                }
                                            )
                                            ->values()
                                            ->toArray()
                                    )
                                    ->columnSpanFull()
                                    ->vertical()
                                    ->persistTabInQueryString(),
                            ]
                            : [
                                EmptyState::make('Belum Ada Data Presensi')
                                    ->description(
                                        'Belum ada data presensi untuk kelas ini. Data presensi akan muncul setelah guru melakukan presensi melalui jurnal mengajar.'
                                    )
                                    ->icon('heroicon-o-calendar-days')
                                    ->columnSpanFull(),
                            ]
                        ),

                    // Penilaian
                    Tab::make('Penilaian')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->schema(
                            $this->hasAssessmentData()
                            ? [
                                Tabs::make('Mapel Penilaian')
                                    ->tabs(
                                        collect($this->getClassSubjects())
                                            ->map(
                                                function ($subjectName, $subjectId) {
                                                    return Tab::make($subjectName)
                                                        ->schema([
                                                            Grid::make(1)
                                                                ->schema(
                                                                    fn(): array =>
                                                                    $this->getWidgetsSchemaComponents([
                                                                        StudentAssessmentReports::make([
                                                                            'classId' => $this->record->id,
                                                                            'subjectId' => $subjectId,
                                                                        ]),
                                                                    ])
                                                                ),
                                                        ]);
                                                }
                                            )
                                            ->values()
                                            ->toArray()
                                    )
                                    ->columnSpanFull()
                                    ->vertical()
                                    ->persistTabInQueryString(),
                            ]
                            : [
                                EmptyState::make('Belum Ada Data Penilaian')
                                    ->description(
                                        'Belum ada data penilaian untuk kelas ini. Data nilai akan muncul setelah guru melakukan penilaian melalui jurnal mengajar.'
                                    )
                                    ->icon('heroicon-o-clipboard-document-list')
                                    ->columnSpanFull(),
                            ]
                        ),
                ])
                ->columnSpanFull()
                ->persistTabInQueryString(),
        ]);
    }
}