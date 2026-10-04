<?php

namespace App\Filament\Resources\Classes\Pages;

use App\Filament\Resources\Classes\ClassesResource;
use App\Services\PackageService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateClasses extends CreateRecord
{
    protected static string $resource = ClassesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['teacher_id'] = auth()->id();

        return $data;
    }

    protected function beforeCreate(): void
    {
        $packageService = new PackageService(auth()->user());

        if (!$packageService->canAddClass(1)) {
            $limit = $packageService->classLimit();

            Notification::make()
                ->danger()
                ->title('Batas paket tercapai')
                ->body(
                    $limit !== null
                    ? "Paket Anda hanya dapat membuat {$limit} kelas."
                    : 'Anda tidak memiliki paket aktif.'
                )
                ->send();

            $this->halt();
        }
    }
}
