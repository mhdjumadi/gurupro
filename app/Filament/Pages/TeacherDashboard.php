<?php

namespace App\Filament\Pages;

use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class TeacherDashboard extends Page
{
    use HasPageShield;
    protected static ?string $title = 'Beranda Guru';
    protected static ?string $navigationLabel = 'Beranda Guru';
    protected static ?string $modelLabel = 'Beranda Guru';
    protected static ?string $pluralModelLabel = 'Beranda Guru';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected string $view = 'filament.pages.teacher-dashboard';

    public bool $showExpiryWarning = true;

    public ?int $daysRemaining = null;
    public bool $showPaymentWarning = false;

    public function mount(): void
    {
        $user = Auth::user();


        $this->showPaymentWarning = $user->subscriptions()
            ->where('status', 'pending')
            ->exists();

        $subscription = $user->activeSubscription;

        if (!$subscription?->expires_at) {
            $this->showExpiryWarning = false;

            return;
        }

        $this->daysRemaining = max(
            0,
            now()->startOfDay()->diffInDays(
                $subscription->expires_at->startOfDay(),
                false
            )
        );

        // Tampilkan hanya jika masa aktif tersisa 7 hari atau kurang
        $this->showExpiryWarning = $this->daysRemaining <= 7;
    }

    public function closeExpiryWarning(): void
    {
        $this->showExpiryWarning = false;
    }
}
