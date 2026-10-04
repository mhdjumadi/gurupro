<?php

namespace App\Filament\Pages;

use App\Models\Package as PackageModel;
use App\Models\Subscription;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Package extends Page
{
    use HasPageShield;

    protected static ?string $title = 'Paket Saya';

    protected static ?string $navigationLabel = 'Paket Saya';

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.package';

    public bool $showSubscribeModal = false;

    public function getViewData(): array
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Pending lebih diprioritaskan
        |--------------------------------------------------------------------------
        */

        $pendingSubscription = $user->subscriptions()
            ->where('status', 'pending')
            ->latest()
            ->first();

        $subscription = $pendingSubscription
            ?? $user->activeSubscription;

        $currentPackage = null;

        if ($subscription) {
            $currentPackage = [
                'name' => $subscription->package?->name ?? 'Paket',
                'slug' => $subscription->package?->slug,
                'description' => $subscription->package?->description,
                'price' => $subscription->price,
                'type' => $subscription->type,
                'status' => $subscription->status,
                'started_at' => $subscription->started_at,
                'expires_at' => $subscription->expires_at,
                'class_limit' => $subscription->class_limit,
                'student_limit' => $subscription->student_limit,

                'used_classes' => $user->classes()->count(),

                'used_students' => $user->classes()
                    ->withCount('students')
                    ->get()
                    ->sum('students_count'),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Paket upgrade
        |--------------------------------------------------------------------------
        */

        $subscriptionPackage = null;

        $currentPackageSlug = $subscription?->package?->slug;

        $canUpgrade = !$subscription
            || $currentPackageSlug === 'free'
            || in_array($subscription->status, [
                'expired',
                'cancelled',
            ]);

        if ($canUpgrade) {
            $package = PackageModel::query()
                ->where('slug', 'subscription')
                ->where('is_active', true)
                ->first();

            if ($package) {
                $subscriptionPackage = [
                    'id' => $package->id,
                    'name' => $package->name,
                    'slug' => $package->slug,
                    'description' => $package->description,
                    'price' => $package->price,

                    'period' => match ($package->billing_period) {
                        'month' => 'bulan',
                        'year' => 'tahun',
                        default => null,
                    },

                    'class_limit' => $package->class_limit,
                    'student_limit' => $package->student_limit,

                    'features' => [
                        "Maksimal {$package->class_limit} kelas",
                        "Maksimal {$package->student_limit} siswa",
                        'Manajemen siswa',
                        'Jurnal mengajar',
                        'Presensi siswa',
                        'Penilaian siswa',
                        'Export laporan',
                    ],
                ];
            }
        }

        return [
            'currentPackage' => $currentPackage,
            'subscriptionPackage' => $subscriptionPackage,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Buka modal
    |--------------------------------------------------------------------------
    */

    public function openSubscribeModal(): void
    {
        $this->showSubscribeModal = true;
    }

    /*
    |--------------------------------------------------------------------------
    | Tutup modal
    |--------------------------------------------------------------------------
    */

    public function closeSubscribeModal(): void
    {
        $this->showSubscribeModal = false;
    }

    /*
    |--------------------------------------------------------------------------
    | Proses berlangganan
    |--------------------------------------------------------------------------
    */

    public function subscribe(): void
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Cek subscription aktif
        |--------------------------------------------------------------------------
        */

        $activeSubscription = $user->activeSubscription;

        /*
        |--------------------------------------------------------------------------
        | Cek apakah ini perpanjangan
        |--------------------------------------------------------------------------
        */

        $isRenewal = false;

        if (
            $activeSubscription
            && $activeSubscription->package?->slug !== 'free'
            && $activeSubscription->expires_at
        ) {
            $daysRemaining = now()->startOfDay()->diffInDays(
                $activeSubscription->expires_at->startOfDay(),
                false
            );

            $isRenewal = $daysRemaining >= 0 && $daysRemaining <= 7;
        }

        /*
        |--------------------------------------------------------------------------
        | Subscription masih aktif dan belum masuk masa perpanjangan
        |--------------------------------------------------------------------------
        */

        if (
            $activeSubscription
            && $activeSubscription->package?->slug !== 'free'
            && !$isRenewal
        ) {
            $this->showSubscribeModal = false;

            Notification::make()
                ->title('Subscription masih aktif')
                ->body('Perpanjangan dapat dilakukan ketika masa aktif tersisa 7 hari atau kurang.')
                ->warning()
                ->send();

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Cek pending
        |--------------------------------------------------------------------------
        */

        $pendingSubscription = $user->subscriptions()
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($pendingSubscription) {
            $this->showSubscribeModal = false;

            Notification::make()
                ->title('Menunggu pembayaran')
                ->body('Anda sudah memiliki pengajuan langganan yang menunggu pembayaran.')
                ->warning()
                ->send();

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil paket
        |--------------------------------------------------------------------------
        */

        $package = PackageModel::query()
            ->where('slug', 'subscription')
            ->where('is_active', true)
            ->first();

        if (!$package) {
            $this->showSubscribeModal = false;

            Notification::make()
                ->title('Paket tidak tersedia')
                ->body('Paket langganan saat ini tidak tersedia.')
                ->danger()
                ->send();

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Buat pengajuan
        |--------------------------------------------------------------------------
        */

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'type' => 'default',
            'status' => 'pending',
            'price' => $package->price,
            'class_limit' => $package->class_limit,
            'student_limit' => $package->student_limit,
            'started_at' => now(),
            'expires_at' => null,
        ]);

        $this->showSubscribeModal = false;

        Notification::make()
            ->title('Pengajuan berhasil dibuat')
            ->body('Silakan lakukan pembayaran dan kirim bukti pembayaran.')
            ->success()
            ->send();

        /*
        |--------------------------------------------------------------------------
        | Sementara kembali ke halaman paket
        |--------------------------------------------------------------------------
        |
        | Nanti ganti dengan redirect ke halaman pembayaran.
        |
        */

        $this->redirect('/admin/payment');
    }
}