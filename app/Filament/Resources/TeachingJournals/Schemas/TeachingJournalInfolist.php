<?php

namespace App\Filament\Resources\TeachingJournals\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeachingJournalInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('📖 Informasi Jurnal')
                    ->description('Ringkasan kegiatan pembelajaran dan informasi jurnal.')
                    ->schema([
                        // Informasi utama
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('schedule.subject.name')
                                    ->label('Mata Pelajaran')
                                    ->icon('heroicon-o-book-open')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('schedule.class.name')
                                    ->label('Kelas')
                                    ->icon('heroicon-o-academic-cap')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('schedule.teacher.name')
                                    ->label('Guru Pengajar')
                                    ->icon('heroicon-o-user')
                                    ->weight('bold'),

                                TextEntry::make('date')
                                    ->label('Tanggal')
                                    ->icon('heroicon-o-calendar-days')
                                    ->date('d F Y')
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
                                    ->weight('bold')
                                    ->placeholder('-'),
                            ]),

                        // Kegiatan
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('material')
                                    ->label('Materi Pembelajaran')
                                    ->icon('heroicon-o-book-open')
                                    ->placeholder('Belum diisi.')
                                    ->columnSpanFull(),

                                TextEntry::make('activities')
                                    ->label('Kegiatan Pembelajaran')
                                    ->icon('heroicon-o-clipboard-document-list')
                                    ->placeholder('Belum diisi.')
                                    ->columnSpanFull(),

                                TextEntry::make('assessment')
                                    ->label('Penilaian')
                                    ->icon('heroicon-o-document-check')
                                    ->placeholder('Tidak ada penilaian.'),

                                TextEntry::make('notes')
                                    ->label('Catatan')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->placeholder('Tidak ada catatan.'),
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