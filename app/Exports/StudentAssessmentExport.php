<?php

namespace App\Exports;

use App\Models\JournalAssessment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentAssessmentExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    protected int $classId;

    protected ?int $subjectId;

    public function __construct(
        int $classId,
        ?int $subjectId = null
    ) {
        $this->classId = $classId;
        $this->subjectId = $subjectId;
    }

    protected function assessments(): Collection
    {
        return JournalAssessment::query()
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
     * Setiap penilaian dibedakan berdasarkan:
     *
     * jurnal + nama penilaian
     */
    protected function assessmentColumns(): Collection
    {
        return $this->assessments()
            ->map(function (JournalAssessment $assessment) {

                $journal = $assessment->teachingJournal;

                $date = $journal?->date
                    ? \Carbon\Carbon::parse($journal->date)
                        ->format('d M Y')
                    : '-';

                $name = trim($assessment->name);

                return [
                    'journal_id' => $journal?->id,
                    'date' => $date,
                    'name' => $name,

                    'key' =>
                        ($journal?->id ?? '0')
                        . '|'
                        . $name,

                    'label' =>
                        $date
                        . ' - '
                        . $name,
                ];
            })
            ->unique('key')
            ->values();
    }

    public function collection(): Collection
    {
        $students = Student::query()
            ->where('class_id', $this->classId)
            ->orderBy('name')
            ->get();

        $assessments = $this->assessments();

        $columns = $this->assessmentColumns();

        return $students->map(
            function (Student $student) use ($assessments, $columns) {

                $row = [
                    $student->nisn,
                    $student->name,
                ];

                foreach ($columns as $column) {

                    $assessment = $assessments->first(
                        function (JournalAssessment $item) use ($student, $column) {

                            return
                                $item->student_id === $student->id
                                &&
                                $item->teaching_journal_id ===
                                $column['journal_id']
                                &&
                                trim($item->name) ===
                                $column['name'];
                        }
                    );

                    $row[] = $assessment?->score;
                }

                return $row;
            }
        );
    }

    public function headings(): array
    {
        return array_merge(
            [
                'NISN',
                'Nama Siswa',
            ],
            $this->assessmentColumns()
                ->pluck('label')
                ->toArray()
        );
    }
}