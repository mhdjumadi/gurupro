<?php

namespace App\Filament\Resources\TeachingJournals\Pages;

use App\Exports\TeachingJournalPdf;
use App\Filament\Resources\TeachingJournals\TeachingJournalResource;
use App\Livewire\JournalAssessments;
use App\Livewire\JournalAttendances;
use App\Models\TeachingJournal;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ViewTeachingJournal extends ViewRecord
{
    protected static string $resource = TeachingJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {
                    return app(TeachingJournalPdf::class)
                        ->download($this->record->id);
                })
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return TeachingJournalResource::infolist($schema);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getInfolistContentComponent(),

                Tabs::make('Detail Jurnal')
                    ->tabs([
                        Tab::make('Presensi')
                            ->icon('heroicon-o-calendar-days')
                            ->schema([
                                Grid::make(1)
                                    ->schema(fn(): array => $this->getWidgetsSchemaComponents([
                                        JournalAttendances::make([
                                            'journalId' => $this->record->id,
                                        ]),
                                    ])),
                            ]),

                        Tab::make('Penilaian')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                Grid::make(1)
                                    ->schema(fn(): array => $this->getWidgetsSchemaComponents([
                                        JournalAssessments::make([
                                            'journalId' => $this->record->id,
                                        ]),
                                    ])),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}