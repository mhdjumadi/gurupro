<?php

namespace App\Filament\Resources\Classes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClassesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('room')
                    ->required(),
                Select::make('grade')
                    ->label('Tingkatan')
                    ->options([
                        'I' => 'I',
                        'II' => 'II',
                        'III' => 'III',
                        'IV' => 'IV',
                        'V' => 'V',
                        'VI' => 'VI',
                        'VII' => 'VII',
                        'VIII' => 'VIII',
                        'IX' => 'IX',
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ])
                    ->required(),
                TextInput::make('academic_year')
                    ->required(),
            ]);
    }
}
