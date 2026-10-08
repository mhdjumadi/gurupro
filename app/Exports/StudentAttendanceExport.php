<?php

namespace App\Exports;

use App\Models\JournalAttendance;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentAttendanceExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    protected string $classId;

    protected ?string $subjectId;

    public function __construct(
        int $classId,
        ?int $subjectId = null
    ) {
        $this->classId = $classId;
        $this->subjectId = $subjectId;
    }

    /**
     * Ambil semua data presensi untuk kelas.
     */
    protected function attendances(): Collection
    {
        return JournalAttendance::query()
            ->whereHas(
                'teachingJournal.schedule',
                function (Builder $query) {
                    $query->where('class_id', $this->classId);

                    if ($this->subjectId) {
                        $query->where(
                            'subject_id',
                            $this->subjectId
                        );
                    }
                }
            )
            ->with([
                'student',
                'teachingJournal.schedule.subject',
            ])
            ->get();
    }

    /**
     * Setiap presensi dibedakan berdasarkan:
     *
     * teaching_journal_id
     *
     * Karena satu jurnal = satu pertemuan/tanggal.
     */
    protected function attendanceColumns(): Collection
    {
        return $this->attendances()
            ->map(function (JournalAttendance $attendance) {

                $journal = $attendance->teachingJournal;

                $date = $journal?->date
                    ? \Carbon\Carbon::parse(
                        $journal->date
                    )->format('d M Y')
                    : '-';

                return [
                    'journal_id' => $journal?->id,

                    'label' =>
                        $date
                ];
            })
            ->unique('journal_id')
            ->values();
    }

    /**
     * Data Excel.
     */
    public function collection(): Collection
    {
        $students = Student::query()
            ->where(
                'class_id',
                $this->classId
            )
            ->orderBy('name')
            ->get();

        $attendances = $this->attendances();

        $columns = $this->attendanceColumns();

        return $students->map(
            function (Student $student) use ($attendances, $columns) {

                $row = [
                    $student->nisn,
                    $student->name,
                ];

                foreach ($columns as $column) {

                    $attendance = $attendances->first(
                        function (JournalAttendance $item) use ($student, $column) {

                            return
                                $item->student_id ===
                                $student->id
                                &&
                                $item->teaching_journal_id ===
                                $column['journal_id'];
                        }
                    );

                    $row[] = $attendance?->status;
                }

                return $row;
            }
        );
    }

    /**
     * Header Excel.
     */
    public function headings(): array
    {
        return array_merge(
            [
                'NISN',
                'Nama Siswa',
            ],
            $this->attendanceColumns()
                ->pluck('label')
                ->toArray()
        );
    }
}