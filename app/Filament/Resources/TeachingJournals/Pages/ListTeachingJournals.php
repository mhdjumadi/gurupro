<?php

namespace App\Filament\Resources\TeachingJournals\Pages;

use App\Exports\TeachingJournalPdf;
use App\Filament\Resources\TeachingJournals\TeachingJournalResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;

class ListTeachingJournals extends ListRecords
{
    protected static string $resource = TeachingJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Jurnal Mengajar'),
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {

                    return app(TeachingJournalPdf::class)
                        ->download($this->tableFilters ?? []);
                }),
        ];
    }
}
