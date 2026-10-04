<?php

namespace App\Filament\Pages;

use App\Models\Subscription;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Payment extends Page
{
    protected static ?string $title = 'Pembayaran';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.payment';

    public ?Subscription $subscription = null;

    public function mount(): void
    {
        $this->subscription = Auth::user()
            ->subscriptions()
            ->with('package')
            ->where('status', 'pending')
            ->latest()
            ->first();

        if (!$this->subscription) {
            $this->redirect('/admin/package');

            return;
        }
    }

    public function getWhatsappUrl(): string
    {
        $phone = '6281234567890';

        $message = urlencode(
            "Halo Admin GuruPro,\n\n"
            . "Saya sudah melakukan pembayaran langganan.\n\n"
            . "Nama: " . Auth::user()->name . "\n"
            . "Paket: " . ($this->subscription?->package?->name ?? '-') . "\n"
            . "Nominal: Rp " . number_format(
                $this->subscription?->price ?? 0,
                0,
                ',',
                '.'
            ) . "\n\n"
            . "Mohon dicek dan diverifikasi. Terima kasih."
        );

        return "https://wa.me/{$phone}?text={$message}";
    }
}