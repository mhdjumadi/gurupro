<?php

namespace App\Filament\Resources\TeachingJournals\Schemas;

use App\Models\Schedule;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TeachingJournalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('schedule_id')
                    ->label('Jadwal')
                    ->relationship(
                        name: 'schedule',
                        titleAttribute: 'id',
                        modifyQueryUsing: function (Builder $query) {
                            $user = Auth::user();

                            if ($user->hasRole('super_admin')) {
                                return;
                            }

                            $query
                                ->where('teacher_id', $user->id)
                                ->whereHas('class.students');
                        }
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                            match ((int) $record->day) {
                                1 => 'Senin',
                                2 => 'Selasa',
                                3 => 'Rabu',
                                4 => 'Kamis',
                                5 => 'Jumat',
                                6 => 'Sabtu',
                                7 => 'Minggu',
                                default => '-',
                            }
                            . " ({$record->start_time->format('H:i')} - "
                            . ($record->end_time?->format('H:i') ?? '-')
                            . ")"
                            . " - {$record->class->name}"
                            . " - {$record->subject->name}"
                    )
                    ->default(fn() => request()->query('schedule_id'))
                    ->live()
                    ->afterStateUpdated(function ($state, $set): void {
                        if (!$state) {
                            $set('start_time', null);
                            $set('end_time', null);

                            return;
                        }

                        $schedule = Schedule::find($state);

                        if (!$schedule) {
                            return;
                        }

                        $set(
                            'start_time',
                            $schedule->start_time
                            ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
                            : null
                        );

                        $set(
                            'end_time',
                            $schedule->end_time
                            ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
                            : null
                        );
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('date')
                    ->label('Tanggal Pertemuan')
                    ->default(now())
                    ->required(),

                Select::make('semester')
                    ->label('Semester')
                    ->options([
                        'ganjil' => 'Ganjil',
                        'genap' => 'Genap',
                    ])
                    ->required(),

                Grid::make(2)
                    ->schema([
                        TimePicker::make('start_time')
                            ->label('Jam Mulai')
                            ->seconds(false)
                            ->required(),

                        TimePicker::make('end_time')
                            ->label('Jam Selesai')
                            ->seconds(false)
                            ->required(),
                    ])
                    ->columnSpanFull(),

                Textarea::make('material')
                    ->label('Materi Pembelajaran')
                    ->placeholder('Materi yang disampaikan pada pertemuan ini...')
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('activities')
                    ->label('Kegiatan Pembelajaran')
                    ->placeholder('Kegiatan yang dilakukan selama pembelajaran...')
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('assessment')
                    ->label('Penilaian')
                    ->placeholder('Contoh: Praktik, pilihan ganda, essay, atau kosong jika tidak ada penilaian...')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('notes')
                    ->label('Catatan')
                    ->placeholder('Catatan tambahan...')
                    ->rows(3)
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}