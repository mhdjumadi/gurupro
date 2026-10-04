<?php

namespace App\Livewire;

use App\Filament\Imports\StudentImporter;
use App\Models\Student;
use App\Services\PackageService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ImportAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ClassStudents extends TableWidget
{
    public ?string $classId = null;

    protected static ?string $heading = '👥 Daftar Siswa';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => Student::query()
                    ->where('class_id', $this->classId)
            )
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),

                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
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

                TextColumn::make('birth_place')
                    ->label('Tempat Lahir')
                    ->placeholder('-')
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->placeholder('-')
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                TextColumn::make('phone')
                    ->label('No. Telepon')
                    ->placeholder('-')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->headerActions([
                $this->addStudentAction(),
                $this->importStudentAction(),
            ])
            ->recordActions([
                $this->detailStudentAction(),
                $this->editStudentAction(),
                $this->deleteStudentAction(),
            ])
            ->filters([])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ])
            ->defaultSort('name');
    }

    // =========================================================
    // HEADER ACTION
    // =========================================================

    protected function addStudentAction(): Action
    {
        $packageService = new PackageService(auth()->user());

        $remaining = max(
            0,
            $packageService->studentLimit()
            - $packageService->usedStudents()
        );

        return
            Action::make('addStudent')
                ->label('Tambah Siswa')
                ->disabled($remaining <= 0)
                ->icon('heroicon-o-user-plus')
                ->form([
                    TextInput::make('nisn')
                        ->label('NISN')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('name')
                        ->label('Nama Siswa')
                        ->required()
                        ->maxLength(255),

                    Select::make('gender')
                        ->label('Jenis Kelamin')
                        ->options([
                            'l' => 'Laki-laki',
                            'p' => 'Perempuan',
                        ])
                        ->required(),

                    TextInput::make('birth_place')
                        ->label('Tempat Lahir'),

                    DatePicker::make('birth_date')
                        ->label('Tanggal Lahir'),

                    TextInput::make('phone')
                        ->label('No. Telepon'),

                    Textarea::make('address')
                        ->label('Alamat')
                        ->columnSpanFull(),
                ])
                ->action(function (array $data): void {
                    $teacherId = auth()->id();

                    // Cek apakah siswa sudah ada di kelas ini
                    $exists = Student::query()
                        ->where('class_id', $this->classId)
                        ->where('nisn', $data['nisn'])
                        ->exists();

                    if ($exists) {
                        Notification::make()
                            ->title('Siswa sudah terdaftar')
                            ->body(
                                'Siswa dengan NISN tersebut sudah terdaftar di kelas ini.'
                            )
                            ->warning()
                            ->send();

                        return;
                    }

                    // Cek kuota guru secara keseluruhan
                    $packageService = new PackageService(auth()->user());

                    if (!$packageService->canAddStudents(1)) {
                        Notification::make()
                            ->title('Kuota siswa sudah penuh')
                            ->body(
                                'Anda sudah mencapai batas '
                                . $packageService->studentLimit()
                                . ' siswa.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    Student::create([
                        ...$data,
                        'teacher_id' => $teacherId,
                        'class_id' => $this->classId,
                    ]);

                    Notification::make()
                        ->title('Siswa berhasil ditambahkan')
                        ->success()
                        ->send();

                    $this->resetTable();
                });
    }

    protected function importStudentAction(): ImportAction
    {
        $packageService = new PackageService(auth()->user());

        $remaining = max(
            0,
            $packageService->studentLimit()
            - $packageService->usedStudents()
        );

        return ImportAction::make('importStudent')
            ->label('Import Siswa')
            ->disabled($remaining <= 0)
            ->icon('heroicon-o-arrow-up-tray')
            ->color('gray')
            ->importer(StudentImporter::class)
            ->maxRows($remaining)
            ->options([
                'teacher_id' => auth()->id(),
                'class_id' => $this->classId,
            ]);
    }

    // =========================================================
    // RECORD ACTION
    // =========================================================

    protected function detailStudentAction(): Action
    {
        return Action::make('detail')
            ->label('Detail')
            ->icon('heroicon-o-eye')
            ->url(
                fn(Student $record): string => route(
                    'filament.admin.resources.students.view',
                    ['record' => $record->getKey()]
                )
            );
    }

    protected function editStudentAction(): Action
    {
        return Action::make('edit')
            ->label('Edit')
            ->icon('heroicon-o-pencil-square')
            ->schema([
                TextInput::make('nisn')
                    ->label('NISN')
                    ->required(),

                TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'l' => 'Laki-laki',
                        'p' => 'Perempuan',
                    ])
                    ->required(),

                TextInput::make('birth_place')
                    ->label('Tempat Lahir'),

                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir'),

                TextInput::make('phone')
                    ->label('No. HP'),

                Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3),
            ])
            ->fillForm(
                fn(Student $record): array => [
                    'nisn' => $record->nisn,
                    'name' => $record->name,
                    'gender' => $record->gender,
                    'birth_place' => $record->birth_place,
                    'birth_date' => $record->birth_date,
                    'phone' => $record->phone,
                    'address' => $record->address,
                ]
            )
            ->action(function (Student $record, array $data): void {
                $record->update($data);
            })
            ->successNotificationTitle(
                'Data siswa berhasil diperbarui'
            );
    }

    protected function deleteStudentAction(): DeleteAction
    {
        return DeleteAction::make('delete')
            ->label('Hapus')
            ->icon('heroicon-o-trash')
            ->requiresConfirmation()
            ->modalHeading('Hapus Siswa')
            ->modalDescription(
                'Apakah Anda yakin ingin menghapus siswa ini? '
                . 'Data yang sudah dihapus tidak dapat dikembalikan.'
            )
            ->successNotificationTitle(
                'Siswa berhasil dihapus'
            );
    }
}