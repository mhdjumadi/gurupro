<?php

namespace App\Filament\Imports;

use App\Models\Student;
use App\Services\PackageService;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Notifications\Notification;
use Illuminate\Support\Number;

class StudentImporter extends Importer
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nisn')
                ->label('NISN')
                ->examples([
                    '0012345678',
                    '0012345679',
                ])
                ->requiredMapping()
                ->rules([
                    'required',
                    'string',
                ]),

            ImportColumn::make('name')
                ->label('Nama')
                ->examples([
                    'Ahmad Fauzi',
                    'Siti Aminah',
                ])
                ->requiredMapping()
                ->rules([
                    'required',
                    'string',
                ]),

            ImportColumn::make('gender')
                ->label('Jenis Kelamin')
                ->examples([
                    'l',
                    'p',
                ])
                ->requiredMapping()
                ->rules([
                    'required',
                    'in:l,p',
                ]),

            ImportColumn::make('birth_place')
                ->label('Tempat Lahir')
                ->examples([
                    'Tanjung Selor',
                    'Tarakan',
                ]),

            ImportColumn::make('birth_date')
                ->label('Tanggal Lahir')
                ->examples([
                    '2012-05-10',
                    '2012-07-12',
                ])
                ->rules([
                    'nullable',
                    'date',
                ]),

            ImportColumn::make('phone')
                ->label('No. HP')
                ->examples([
                    '081234567890',
                    '081298765432',
                ]),

            ImportColumn::make('address')
                ->label('Alamat')
                ->examples([
                    'Jl. Sengkawit No. 10',
                    'Jl. Durian No. 5',
                ]),
        ];
    }

    public function resolveRecord(): ?Student
    {
        $nisn = $this->data['nisn'] ?? null;
        $classId = $this->options['class_id'] ?? null;

        if (!filled($nisn) || !filled($classId)) {
            return null;
        }

        return Student::query()
            ->where('class_id', $classId)
            ->where('nisn', $nisn)
            ->first()
            ?? new Student([
                'class_id' => $classId,
            ]);
    }

    public static function getCompletedNotificationTitle(
        Import $import
    ): string {
        return 'Import siswa selesai';
    }

    public static function getCompletedNotificationBody(
        Import $import
    ): string {
        $body = 'Sebanyak '
            . Number::format($import->successful_rows)
            . ' siswa berhasil diimport.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '
                . Number::format($failedRowsCount)
                . ' data gagal diimport.';
        }

        return $body;
    }
}