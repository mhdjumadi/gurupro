<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Guru')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('package.name')
                    ->label('Paket')
                    ->badge()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'default' => 'Default',
                            'custom' => 'Custom',
                            default => ucfirst($state),
                        }
                    )
                    ->color(
                        fn (string $state): string => match ($state) {
                            'default' => 'gray',
                            'custom' => 'warning',
                            default => 'gray',
                        }
                    ),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('class_limit')
                    ->label('Kelas')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('student_limit')
                    ->label('Siswa')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'active' => 'Aktif',
                            'expired' => 'Expired',
                            'cancelled' => 'Dibatalkan',
                            default => ucfirst($state),
                        }
                    )
                    ->color(
                        fn (string $state): string => match ($state) {
                            'active' => 'success',
                            'expired' => 'gray',
                            'cancelled' => 'danger',
                            default => 'gray',
                        }
                    )
                    ->sortable(),

                TextColumn::make('started_at')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label('Berakhir')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'expired' => 'Expired',
                        'cancelled' => 'Dibatalkan',
                    ]),

                SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'default' => 'Default',
                        'custom' => 'Custom',
                    ]),

                SelectFilter::make('package_id')
                    ->label('Paket')
                    ->relationship(
                        name: 'package',
                        titleAttribute: 'name'
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
