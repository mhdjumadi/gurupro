<?php

namespace App\Filament\Resources\Classes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClassesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kelas')
                    ->description('Informasi utama kelas dan guru kelas.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama Kelas')
                                    ->icon('heroicon-o-building-office-2')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('room')
                                    ->label('Ruang Kelas')
                                    ->icon('heroicon-o-building-office')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('grade')
                                    ->label('Tingkat')
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('academic_year')
                                    ->label('Tahun Ajaran')
                                    ->icon('heroicon-o-calendar-days'),

                                TextEntry::make('teacher.name')
                                    ->label('Guru Kelas')
                                    ->icon('heroicon-o-user')
                                    ->placeholder('Belum ditentukan'),
                            ]),

                        // Informasi sistem sebagai footer
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->icon('heroicon-o-plus-circle')
                                    ->dateTime('d F Y, H:i')
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->icon('heroicon-o-arrow-path')
                                    ->dateTime('d F Y, H:i')
                                    ->placeholder('-'),
                            ])
                            ->extraAttributes([
                                'class' => 'pt-4 mt-2 border-t border-gray-200 dark:border-gray-700',
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}