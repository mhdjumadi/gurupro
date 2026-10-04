<?php

namespace App\Filament\Resources\TeachingJournals\Tables;

use App\Models\JournalAttendance;
use App\Models\TeachingJournal;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TeachingJournalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('teacher.name')
                    ->sortable()
                    ->visible(fn() => Auth::user()->hasRole('super_admin')),
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('schedule.class.name')
                    ->label('Kelas')
                    ->sortable(),
                TextColumn::make('schedule_info')
                    ->label('Jadwal')
                    ->state(function ($record) {
                        $schedule = $record->schedule;

                        if (!$schedule) {
                            return '-';
                        }
                        $start = $record->start_time
                            ? \Carbon\Carbon::parse($record->start_time)->format('H:i')
                            : '-';

                        $end = $record->end_time
                            ? \Carbon\Carbon::parse($record->end_time)->format('H:i')
                            : '-';

                        $subject = $schedule->subject?->name ?? '-';

                        return "{$subject} - ({$start} - {$end})";
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('semester')
                    ->label('Semester')
                    ->formatStateUsing(fn($state) => match ((string) $state) {
                        'ganjil' => 'Ganjil',
                        'genap' => 'Genap',
                        default => '-',
                    }),
                TextColumn::make('notes')
                    ->label('Catatan'),
                TextColumn::make('hadir')
                    ->label('Hadir')
                    ->getStateUsing(
                        fn($record) =>
                            JournalAttendance::query()
                                ->where('teaching_journal_id', $record->id)
                                ->where('status', 'hadir')
                                ->count()
                    )
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                TextColumn::make('sakit')
                    ->label('Sakit')
                    ->getStateUsing(
                        fn($record) =>
                            JournalAttendance::query()
                                ->where('teaching_journal_id', $record->id)
                                ->where('status', 'sakit')
                                ->count()
                    )
                    ->badge()
                    ->color('warning')
                    ->alignCenter(),
                TextColumn::make('izin')
                    ->label('Izin')
                    ->getStateUsing(
                        fn($record) =>
                            JournalAttendance::query()
                                ->where('teaching_journal_id', $record->id)
                                ->where('status', 'izin')
                                ->count()
                    )
                    ->badge()
                    ->color('info')
                    ->alignCenter(),
                TextColumn::make('alpa')
                    ->label('Alpa')
                    ->getStateUsing(
                        fn($record) =>
                            JournalAttendance::query()
                                ->where('teaching_journal_id', $record->id)
                                ->where('status', 'alpa')
                                ->count()
                    )
                    ->badge()
                    ->color('danger')
                    ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('semester')
                    ->label('Semester')
                    ->options([
                        'ganjil' => 'Ganjil',
                        'genap' => 'Genap',
                    ]),

                SelectFilter::make('class_id')
                    ->label('Kelas')
                    ->relationship(
                        name: 'schedule.class',
                        titleAttribute: 'name',
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('subject_id')
                    ->label('Mata Pelajaran')
                    ->relationship(
                        name: 'schedule.subject',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query) {
                            $scheduleIds = TeachingJournal::query()
                                ->where('teacher_id', auth()->id())
                                ->pluck('schedule_id');

                            $query->whereHas('schedules', function ($query) use ($scheduleIds) {
                                $query->whereIn('id', $scheduleIds);
                            });
                        },
                    )
                    ->searchable()
                    ->preload(),

                Filter::make('date_range')
                    ->label('Rentang Tanggal')
                    ->schema([
                        DatePicker::make('date_from')
                            ->label('Dari Tanggal'),

                        DatePicker::make('date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['date_from'] ?? null,
                                fn($query, $date) =>
                                    $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'] ?? null,
                                fn($query, $date) =>
                                    $query->whereDate('date', '<=', $date),
                            );
                    }),
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
