<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Subscription')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Guru')
                            ->placeholder('-'),

                        TextEntry::make('package.name')
                            ->label('Paket')
                            ->placeholder('-'),

                        TextEntry::make('type')
                            ->label('Tipe')
                            ->badge()
                            ->formatStateUsing(
                                fn(string $state): string => match ($state) {
                                    'default' => 'Default',
                                    'custom' => 'Custom',
                                    default => ucfirst($state),
                                }
                            )
                            ->color(
                                fn(string $state): string => match ($state) {
                                    'default' => 'gray',
                                    'custom' => 'warning',
                                    default => 'gray',
                                }
                            ),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(
                                fn(string $state): string => match ($state) {
                                    'pending' => 'Menunggu Pembayaran',
                                    'active' => 'Aktif',
                                    'expired' => 'Expired',
                                    'cancelled' => 'Dibatalkan',
                                    default => ucfirst($state),
                                }
                            )
                            ->color(
                                fn(string $state): string => match ($state) {
                                    'pending' => 'warning',
                                    'active' => 'success',
                                    'expired' => 'gray',
                                    'cancelled' => 'danger',
                                    default => 'gray',
                                }
                            ),
                    ])
                    ->columns(2),

                Section::make('Detail Paket')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Harga')
                            ->money('IDR'),

                        TextEntry::make('class_limit')
                            ->label('Maksimal Kelas')
                            ->suffix(' kelas'),

                        TextEntry::make('student_limit')
                            ->label('Maksimal Siswa')
                            ->suffix(' siswa'),
                    ])
                    ->columns(3),

                Section::make('Periode Subscription')
                    ->schema([
                        TextEntry::make('started_at')
                            ->label('Mulai')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('expires_at')
                            ->label('Berakhir')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Informasi Sistem')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diubah')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}