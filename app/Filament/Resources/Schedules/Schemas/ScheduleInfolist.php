<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('📅 Informasi Jadwal')
                    ->description('Informasi mata pelajaran, kelas, guru, dan waktu pembelajaran.')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        // Informasi utama
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('subject.name')
                                    ->label('Mata Pelajaran')
                                    ->icon('heroicon-o-book-open')
                                    ->weight('bold')
                                    ->size('lg')
                                    ->placeholder('Belum ditentukan'),

                                TextEntry::make('class.name')
                                    ->label('Kelas')
                                    ->icon('heroicon-o-academic-cap')
                                    ->weight('bold')
                                    ->size('lg')
                                    ->placeholder('Belum ditentukan'),

                                TextEntry::make('teacher.name')
                                    ->label('Guru Pengajar')
                                    ->icon('heroicon-o-user')
                                    ->weight('bold')
                                    ->placeholder('Belum ditentukan'),

                                TextEntry::make('day')
                                    ->label('Hari')
                                    ->icon('heroicon-o-calendar')
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('start_time')
                                    ->label('Jam Mulai')
                                    ->icon('heroicon-o-play')
                                    ->time('H:i')
                                    ->weight('bold'),

                                TextEntry::make('end_time')
                                    ->label('Jam Selesai')
                                    ->icon('heroicon-o-stop')
                                    ->time('H:i')
                                    ->weight('bold'),
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