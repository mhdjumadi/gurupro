<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('👨‍🎓 Informasi Siswa')
                    ->description('Informasi dasar dan data siswa.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        // Informasi utama
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama Siswa')
                                    ->icon('heroicon-o-user')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('nisn')
                                    ->label('NISN')
                                    ->icon('heroicon-o-identification')
                                    ->weight('bold'),

                                TextEntry::make('class.name')
                                    ->label('Kelas')
                                    ->icon('heroicon-o-academic-cap')
                                    ->weight('bold')
                                    ->placeholder('Belum ditentukan'),

                                TextEntry::make('gender')
                                    ->label('Jenis Kelamin')
                                    ->icon('heroicon-o-user-group')
                                    ->formatStateUsing(fn($state) => match ($state) {
                                        'l' => 'Laki-laki',
                                        'p' => 'Perempuan',
                                        default => '-',
                                    })
                                    ->badge()
                                    ->color(fn($state) => match ($state) {
                                        'l' => 'info',
                                        'p' => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('birth_place')
                                    ->label('Tempat Lahir')
                                    ->icon('heroicon-o-map-pin')
                                    ->placeholder('-'),

                                TextEntry::make('birth_date')
                                    ->label('Tanggal Lahir')
                                    ->icon('heroicon-o-calendar-days')
                                    ->date('d F Y')
                                    ->placeholder('-'),
                            ]),

                        // Kontak & alamat
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('phone')
                                    ->label('No. HP')
                                    ->icon('heroicon-o-phone')
                                    ->placeholder('-'),

                                TextEntry::make('address')
                                    ->label('Alamat')
                                    ->icon('heroicon-o-map-pin')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),

                        // Informasi sistem
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