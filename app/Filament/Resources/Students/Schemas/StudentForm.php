<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nisn')
                    ->label('NISN')
                    ->required()
                    ->maxLength(255),

                TextInput::make('name')
                    ->label('Nama Siswa')
                    ->required()
                    ->maxLength(255),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'l' => 'Laki-laki',
                        'p' => 'Perempuan',
                    ])
                    ->required(),

                TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->maxLength(255),

                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir'),

                TextInput::make('phone')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(255),

                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),
            ]);
    }
}