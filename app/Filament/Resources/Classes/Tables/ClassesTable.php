<?php

namespace App\Filament\Resources\Classes\Tables;

use App\Models\Classes;
use App\Models\Student;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ClassesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->numeric()
                    ->sortable()
                    ->visible(fn() => Auth::user()->hasRole('super_admin')),
                TextColumn::make('name')
                    ->label('Nama Kelas')
                    ->searchable(),
                TextColumn::make('grade')
                    ->label('Tingkatan')
                    ->searchable(),
                TextColumn::make('academic_year')
                    ->label('Tahun Akademik')
                    ->searchable(),
                TextColumn::make('count_student')
                    ->label('Jumlah Siswa')
                    ->getStateUsing(
                        fn($record) =>
                            Student::query()
                                ->where('class_id', $record->id)
                                ->count()
                    )
                    ->badge()
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
