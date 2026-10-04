<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Subscription')
                    ->schema([
                        Select::make('user_id')
                            ->label('Guru')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn(Builder $query) =>
                                    $query->role('teacher')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('package_id')
                            ->label('Paket')
                            ->relationship(
                                name: 'package',
                                titleAttribute: 'name'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('type')
                            ->label('Tipe Subscription')
                            ->options([
                                'default' => 'Default',
                                'custom' => 'Custom',
                            ])
                            ->default('default')
                            ->required()
                            ->live(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Aktif',
                                'pending' => 'Menunggu Pembayaran',
                                'expired' => 'Expired',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->default('active')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Detail Subscription')
                    ->schema([
                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('IDR')
                            ->required()
                            ->minValue(0),

                        TextInput::make('class_limit')
                            ->label('Maksimal Kelas')
                            ->numeric()
                            ->required()
                            ->minValue(1),

                        TextInput::make('student_limit')
                            ->label('Maksimal Siswa')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                    ])
                    ->columns(3),

                Section::make('Periode Subscription')
                    ->schema([
                        DateTimePicker::make('started_at')
                            ->label('Mulai')
                            ->required()
                            ->default(now()),

                        DateTimePicker::make('expires_at')
                            ->label('Berakhir')
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }
}
