<?php

namespace App\Filament\Resources\Users\Schemas;

use Spatie\Permission\Models\Role;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nip')
                    ->label('NIP')
                    ->required(function ($get): bool {
                        $roleIds = $get('roles') ?? [];

                        return Role::query()
                            ->whereIn('id', $roleIds)
                            ->where('name', 'teacher')
                            ->exists();
                    }),

                TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                TextInput::make('school')
                    ->label('Sekolah'),

                Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required()
                    ->live(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At'),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->dehydrateStateUsing(
                        fn(?string $state): ?string =>
                            filled($state)
                            ? Hash::make($state)
                            : null
                    ),
            ]);
    }
}
