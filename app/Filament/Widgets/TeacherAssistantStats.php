<?php

namespace App\Filament\Widgets;

use App\Models\Classes;
use App\Models\JournalAttendance;
use App\Models\Student;
use App\Models\Schedule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class TeacherAssistantStats extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $teacherID = auth()->id();

        // Total kelas yang diajar guru
        $totalClasses = Classes::query()
            ->where('teacher_id', $teacherID)
            ->count();

        // Total siswa dari seluruh kelas yang diajar guru
        $totalStudents = Student::query()
            ->whereHas('class', function ($query) use ($teacherID) {
                $query->where('teacher_id', $teacherID);
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Kehadiran Hari Ini
        |--------------------------------------------------------------------------
        | Hanya menghitung siswa yang sudah memiliki data presensi
        | pada jurnal pembelajaran hari ini.
        |
        | Jadi siswa dari kelas yang belum memiliki jurnal hari ini
        | tidak ikut dihitung.
        */
        $attendanceToday = JournalAttendance::query()
            ->whereHas('teachingJournal', function ($query) use ($teacherID, $today) {
                $query
                    ->where('teacher_id', $teacherID)
                    ->whereDate('date', $today);
            })
            ->get();

        $totalStudentsToday = $attendanceToday->count();

        $presentToday = $attendanceToday
            ->where('status', 'hadir')
            ->count();

        $attendancePercentage = $totalStudentsToday > 0
            ? round(($presentToday / $totalStudentsToday) * 100, 1)
            : 0;

        // Jadwal hari ini
        $todayDay = $today->dayOfWeek;

        $todaySchedules = Schedule::query()
            ->where('day', $todayDay)
            ->where('teacher_id', $teacherID)
            ->count();

        return [
            Stat::make(
                'Total Kelas',
                number_format($totalClasses)
            )
                ->description('Kelas yang sedang diasistensi')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('primary'),

            Stat::make(
                'Total Siswa',
                number_format($totalStudents)
            )
                ->description('Siswa dari seluruh kelas')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make(
                'Kehadiran Hari Ini',
                "{$presentToday} / {$totalStudentsToday}"
            )
                ->description(
                    $totalStudentsToday > 0
                    ? "{$attendancePercentage}% siswa hadir"
                    : 'Belum ada presensi hari ini'
                )
                ->descriptionIcon('heroicon-m-check-circle')
                ->color(
                    $totalStudentsToday === 0
                    ? 'gray'
                    : (
                        $attendancePercentage >= 90
                        ? 'success'
                        : (
                            $attendancePercentage >= 75
                            ? 'warning'
                            : 'danger'
                        )
                    )
                ),

            Stat::make(
                'Jadwal Hari Ini',
                number_format($todaySchedules)
            )
                ->description('Jadwal pembelajaran hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
        ];
    }
}