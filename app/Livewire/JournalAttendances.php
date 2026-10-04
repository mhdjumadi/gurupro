<?php

namespace App\Livewire;

use App\Models\JournalAttendance;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class JournalAttendances extends TableWidget
{
    public ?string $journalId = null;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => JournalAttendance::query()
                    ->where('teaching_journal_id', $this->journalId)
                    ->with('student')
            )
            ->heading('📋 Presensi Siswa')
            ->columns([
                TextColumn::make('student.nisn')
                    ->label('NISN')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                ViewColumn::make('hadir')
                    ->label('H')
                    ->view('livewire.journal-attendance-radio')
                    ->extraAttributes([
                        'class' => 'text-center',
                    ])
                    ->state(fn(JournalAttendance $record) => [
                        'record' => $record,
                        'status' => 'hadir',
                    ]),

                ViewColumn::make('sakit')
                    ->label('S')
                    ->view('livewire.journal-attendance-radio')
                    ->extraAttributes([
                        'class' => 'text-center',
                    ])
                    ->state(fn(JournalAttendance $record) => [
                        'record' => $record,
                        'status' => 'sakit',
                    ]),

                ViewColumn::make('izin')
                    ->label('I')
                    ->view('livewire.journal-attendance-radio')
                    ->extraAttributes([
                        'class' => 'text-center',
                    ])
                    ->state(fn(JournalAttendance $record) => [
                        'record' => $record,
                        'status' => 'izin',
                    ]),

                ViewColumn::make('alpa')
                    ->label('A')
                    ->view('livewire.journal-attendance-radio')
                    ->extraAttributes([
                        'class' => 'text-center',
                    ])
                    ->state(fn(JournalAttendance $record) => [
                        'record' => $record,
                        'status' => 'alpa',
                    ]),

                TextInputColumn::make('note')
                    ->label('Catatan')
                    ->placeholder('Catatan...')
                    ->rules([
                        'nullable',
                        'string',
                        'max:500',
                    ]),
            ])
            ->defaultSort('student.name');
    }

    public function updateStatus(string $attendanceId, string $status): void
    {
        JournalAttendance::query()
            ->whereKey($attendanceId)
            ->where('teaching_journal_id', $this->journalId)
            ->update([
                'status' => $status,
            ]);

        $this->resetTable();
    }
}