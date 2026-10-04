<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Package;
use App\Models\Subscription;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;

        // Hanya buat subscription untuk teacher
        if (!$user->hasRole('teacher')) {
            return;
        }

        $freePackage = Package::query()
            ->where('slug', 'free')
            ->where('is_active', true)
            ->first();

        if (!$freePackage) {
            return;
        }

        Subscription::create([
            'user_id' => $user->id,
            'package_id' => $freePackage->id,
            'type' => 'default',
            'status' => 'active',
            'price' => $freePackage->price,
            'class_limit' => $freePackage->class_limit,
            'student_limit' => $freePackage->student_limit,
            'started_at' => now(),
            'expires_at' => null,
        ]);
    }
}