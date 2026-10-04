<?php

namespace App\Filament\Pages;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class AdminDashboard extends Page
{
    use HasPageShield;
    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $modelLabel = 'Dashboard';
    protected static ?string $pluralModelLabel = 'Dashboard';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;
    protected string $view = 'filament.pages.admin-dashboard';


    public function getViewData(): array
    {
        $now = now();

        /*
        |--------------------------------------------------------------------------
        | Guru
        |--------------------------------------------------------------------------
        */

        $totalTeachers = User::role('teacher')->count();

        $newTeachersThisMonth = User::role('teacher')
            ->whereBetween('created_at', [
                $now->copy()->startOfMonth(),
                $now->copy()->endOfMonth(),
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Kelas & Siswa
        |--------------------------------------------------------------------------
        */

        $totalClasses = Classes::count();

        $totalStudents = Student::count();

        /*
        |--------------------------------------------------------------------------
        | Subscription
        |--------------------------------------------------------------------------
        */

        $activeSubscriptions = Subscription::query()
            ->where('status', 'active')
            ->count();

        $pendingSubscriptions = Subscription::query()
            ->where('status', 'pending')
            ->count();

        $expiredSubscriptions = Subscription::query()
            ->where('status', 'expired')
            ->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('subscriptions as newer')
                    ->whereColumn('newer.user_id', 'subscriptions.user_id')
                    ->whereColumn('newer.created_at', '>', 'subscriptions.created_at');
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Subscription akan berakhir dalam 7 hari
        |--------------------------------------------------------------------------
        */

        $expiringSubscriptions = Subscription::query()
            ->where('status', 'active')
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [
                $now,
                $now->copy()->addDays(7),
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Subscription terbaru
        |--------------------------------------------------------------------------
        */

        $latestSubscriptions = Subscription::query()
            ->with([
                'user:id,name,email',
                'package:id,name',
            ])
            ->latest()
            ->limit(6)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Guru terbaru
        |--------------------------------------------------------------------------
        */

        $latestTeachers = User::query()
            ->role('teacher')
            ->latest()
            ->limit(6)
            ->get([
                'id',
                'name',
                'email',
                'school',
                'created_at',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Guru dengan subscription pending
        |--------------------------------------------------------------------------
        */

        $pendingSubscriptionList = Subscription::query()
            ->with([
                'user:id,name,email',
                'package:id,name',
            ])
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Guru yang subscription-nya akan habis
        |--------------------------------------------------------------------------
        */

        $expiringSubscriptionList = Subscription::query()
            ->with([
                'user:id,name,email',
                'package:id,name',
            ])
            ->where('status', 'active')
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [
                $now,
                $now->copy()->addDays(7),
            ])
            ->orderBy('expires_at')
            ->limit(5)
            ->get();

        return [
            'stats' => [
                'totalTeachers' => $totalTeachers,
                'newTeachersThisMonth' => $newTeachersThisMonth,
                'totalClasses' => $totalClasses,
                'totalStudents' => $totalStudents,
                'activeSubscriptions' => $activeSubscriptions,
                'pendingSubscriptions' => $pendingSubscriptions,
                'expiredSubscriptions' => $expiredSubscriptions,
                'expiringSubscriptions' => $expiringSubscriptions,
            ],

            'latestSubscriptions' => $latestSubscriptions,

            'latestTeachers' => $latestTeachers,

            'pendingSubscriptionList' => $pendingSubscriptionList,

            'expiringSubscriptionList' => $expiringSubscriptionList,
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }
}
