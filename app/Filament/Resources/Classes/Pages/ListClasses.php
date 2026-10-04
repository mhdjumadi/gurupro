<?php

namespace App\Filament\Resources\Classes\Pages;

use App\Filament\Resources\Classes\ClassesResource;
use App\Services\PackageService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClasses extends ListRecords
{
    protected static string $resource = ClassesResource::class;

    protected function getHeaderActions(): array
    {
        $packageService = new PackageService(auth()->user());

        $limitReached = !$packageService->canAddClass(1);

        return [
            CreateAction::make()
            ->label('Tambah Kelas')
                ->disabled($limitReached)
                ->tooltip(
                    $limitReached
                    ? 'Batas kelas pada paket Anda sudah tercapai'
                    : null
                ),
        ];
    }
}
