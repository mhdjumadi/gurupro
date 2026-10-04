<?php

namespace App\Livewire;

use App\Models\JournalAssessment;
use App\Models\Student;
use App\Models\TeachingJournal;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class JournalAssessments extends TableWidget
{
    public ?string $journalId = null;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $assessmentNames = JournalAssessment::query()
            ->where('teaching_journal_id', $this->journalId)
            ->select('name')
            ->distinct()
            ->orderBy('name')
            ->pluck('name');

        $columns = [
            TextColumn::make('student.nisn')
                ->label('NISN')
                ->searchable()
                ->sortable(),

            TextColumn::make('student.name')
                ->label('Nama Siswa')
                ->searchable()
                ->sortable(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Kolom nilai dinamis
        |--------------------------------------------------------------------------
        */

        foreach ($assessmentNames as $assessmentName) {

            $columns[] = TextInputColumn::make(
                'assessment_' . md5($assessmentName)
            )
                ->label($assessmentName)
                ->type('number')
                ->step(0.01)
                ->placeholder('-')

                ->getStateUsing(
                    function (JournalAssessment $record) use ($assessmentName) {
                        return JournalAssessment::query()
                            ->where('teaching_journal_id', $this->journalId)
                            ->where('student_id', $record->student_id)
                            ->where('name', $assessmentName)
                            ->value('score');
                    }
                )

                ->updateStateUsing(
                    function ($state, JournalAssessment $record) use ($assessmentName) {

                        JournalAssessment::query()
                            ->where('teaching_journal_id', $this->journalId)
                            ->where('student_id', $record->student_id)
                            ->where('name', $assessmentName)
                            ->update([
                                'score' => $state === ''
                                    ? null
                                    : $state,
                            ]);
                    }
                )

                ->rules([
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:100',
                ]);
        }

        return $table

            /*
            |--------------------------------------------------------------------------
            | Query
            |--------------------------------------------------------------------------
            |
            | Daftar siswa diambil berdasarkan record JournalAssessment.
            | Jadi siswa yang belum memiliki assessment tidak akan muncul.
            |
            */

            ->query(
                fn(): Builder => JournalAssessment::query()
                    ->where('teaching_journal_id', $this->journalId)
                    ->with('student')
            )

            ->heading('📊 Penilaian')

            /*
            |--------------------------------------------------------------------------
            | Empty State
            |--------------------------------------------------------------------------
            */

            ->emptyStateHeading('Belum Ada Penilaian')

            ->emptyStateDescription(
                'Belum ada penilaian pada jurnal ini. Klik tombol "Tambah Penilaian" untuk membuat penilaian.'
            )

            ->emptyStateIcon(
                'heroicon-o-clipboard-document-list'
            )

            /*
            |--------------------------------------------------------------------------
            | Header Actions
            |--------------------------------------------------------------------------
            */

            ->headerActions([

                Action::make('addAssessment')
                    ->label('Tambah Penilaian')
                    ->icon('heroicon-o-plus')
                    ->form([
                        TextInput::make('name')
                            ->label('Nama Penilaian')
                            ->placeholder('Contoh: Tugas 1')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->action(function (array $data): void {
                        $this->addAssessment($data['name']);
                    }),

                Action::make('deleteAssessment')
                    ->label('Hapus Penilaian')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->visible(
                        fn(): bool => JournalAssessment::query()
                            ->where('teaching_journal_id', $this->journalId)
                            ->exists()
                    )
                    ->form([
                        Select::make('name')
                            ->label('Pilih Penilaian')
                            ->options(function (): array {
                                return JournalAssessment::query()
                                    ->where(
                                        'teaching_journal_id',
                                        $this->journalId
                                    )
                                    ->select('name')
                                    ->distinct()
                                    ->orderBy('name')
                                    ->pluck('name')
                                    ->mapWithKeys(
                                        fn($name) => [
                                            $name => $name,
                                        ]
                                    )
                                    ->toArray();
                            })
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $this->deleteAssessment($data['name']);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Penilaian')
                    ->modalDescription(
                        'Semua nilai siswa pada penilaian yang dipilih akan ikut dihapus.'
                    )
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])

            ->columns($columns)

            ->defaultSort('student.name');
    }

    /*
    |--------------------------------------------------------------------------
    | Tambah Penilaian
    |--------------------------------------------------------------------------
    */

    public function addAssessment(string $name): void
    {
        $name = trim($name);

        if ($name === '') {
            return;
        }

        $journal = TeachingJournal::with(
            'schedule.class.students'
        )->findOrFail($this->journalId);

        $exists = JournalAssessment::query()
            ->where('teaching_journal_id', $journal->id)
            ->where('name', $name)
            ->exists();

        if ($exists) {
            Notification::make()
                ->title('Penilaian sudah ada')
                ->body(
                    "Penilaian \"{$name}\" sudah dibuat pada jurnal ini."
                )
                ->warning()
                ->send();

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Buat assessment untuk siswa yang ada saat ini
        |--------------------------------------------------------------------------
        */

        foreach ($journal->schedule->class->students as $student) {
            JournalAssessment::create([
                'teaching_journal_id' => $journal->id,
                'student_id' => $student->id,
                'name' => $name,
                'score' => null,
            ]);
        }

        Notification::make()
            ->title('Penilaian berhasil ditambahkan')
            ->body(
                "Penilaian \"{$name}\" berhasil ditambahkan."
            )
            ->success()
            ->send();

        $this->resetTable();

        $this->dispatch('$refresh');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Penilaian
    |--------------------------------------------------------------------------
    */

    public function deleteAssessment(string $name): void
    {
        $deleted = JournalAssessment::query()
            ->where('teaching_journal_id', $this->journalId)
            ->where('name', $name)
            ->delete();

        if ($deleted === 0) {
            Notification::make()
                ->title('Penilaian tidak ditemukan')
                ->warning()
                ->send();

            return;
        }

        Notification::make()
            ->title('Penilaian berhasil dihapus')
            ->body(
                "Penilaian \"{$name}\" dan seluruh nilainya telah dihapus."
            )
            ->success()
            ->send();

        $this->resetTable();

        $this->dispatch('$refresh');
    }
}