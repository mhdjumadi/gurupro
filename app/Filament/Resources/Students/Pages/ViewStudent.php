<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Filament\Resources\Students\Widgets\StudentAttendanceStats;
use App\Livewire\StudentAssessments;
use App\Livewire\StudentAttendances;
use App\Models\JournalAssessment;
use App\Models\JournalAttendance;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\EmptyState;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;

    public function infolist(Schema $schema): Schema
    {
        return StudentResource::infolist($schema);
    }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function hasAttendanceData(): bool
    {
        return JournalAttendance::query()
            ->where('student_id', $this->record->id)
            ->exists();
    }

    protected function hasAssessmentData(): bool
    {
        return JournalAssessment::query()
            ->where('student_id', $this->record->id)
            ->exists();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Informasi siswa
                $this->getInfolistContentComponent(),

                // Statistik siswa
                // Grid::make(1)
                //     ->schema(fn(): array => $this->getWidgetsSchemaComponents([
                //         StudentAttendanceStats::make([
                //             'studentId' => $this->record->id,
                //         ]),
                //     ])),

                // Presensi & Penilaian
                Tabs::make('Detail Siswa')
                    ->tabs([
                        // Presensi
                        Tab::make('Presensi')
                            ->icon('heroicon-o-calendar-days')
                            ->schema(
                                $this->hasAttendanceData()
                                ? [
                                    Grid::make(1)
                                        ->schema(
                                            fn(): array =>
                                            $this->getWidgetsSchemaComponents([
                                                StudentAttendances::make([
                                                    'studentId' => $this->record->id,
                                                ]),
                                            ])
                                        ),
                                ]
                                : [
                                    EmptyState::make('Belum Ada Data Presensi')
                                        ->description(
                                            'Belum ada data presensi untuk siswa ini. Data presensi akan muncul setelah siswa mendapatkan presensi melalui jurnal mengajar.'
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
                                    Grid::make(1)
                                        ->schema(
                                            fn(): array =>
                                            $this->getWidgetsSchemaComponents([
                                                StudentAssessments::make([
                                                    'studentId' => $this->record->id,
                                                ]),
                                            ])
                                        ),
                                ]
                                : [
                                    EmptyState::make('Belum Ada Data Penilaian')
                                        ->description(
                                            'Belum ada data penilaian untuk siswa ini. Data nilai akan muncul setelah guru melakukan penilaian melalui jurnal mengajar.'
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