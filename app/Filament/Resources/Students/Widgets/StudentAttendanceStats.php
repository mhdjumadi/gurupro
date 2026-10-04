<?php

namespace App\Filament\Resources\Students\Widgets;

use App\Models\JournalAttendance;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentAttendanceStats extends StatsOverviewWidget
{
    public ?int $studentId = null;

    protected function getStats(): array
    {
        $attendance = JournalAttendance::query()
            ->where('student_id', $this->studentId)
            ->get();

        $hadir = $attendance
            ->where('status', 'hadir')
            ->count();

        $sakit = $attendance
            ->where('status', 'sakit')
            ->count();

        $izin = $attendance
            ->where('status', 'izin')
            ->count();

        $alpa = $attendance
            ->where('status', 'alpa')
            ->count();

        $total = $attendance->count();

        $persentase = $total > 0
            ? round(($hadir / $total) * 100, 1)
            : 0;

        return [
            Stat::make('Hadir', $hadir)
                ->description('Kehadiran siswa')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Sakit', $sakit)
                ->description('Tidak masuk karena sakit')
                ->descriptionIcon('heroicon-o-heart')
                ->color('warning'),

            Stat::make('Izin', $izin)
                ->description('Tidak masuk dengan izin')
                ->descriptionIcon('heroicon-o-information-circle')
                ->color('info'),

            Stat::make('Alpa', $alpa)
                ->description('Tanpa keterangan')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make(
                'Kehadiran',
                $persentase . '%'
            )
                ->description(
                    $hadir . ' dari ' . $total . ' pertemuan'
                )
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color(
                    match (true) {
                        $persentase >= 90 => 'success',
                        $persentase >= 75 => 'warning',
                        default => 'danger',
                    }
                ),
        ];
    }
}
