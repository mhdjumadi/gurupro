<x-filament-panels::page>

    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HITUNG SISA MASA AKTIF --}}
        {{-- ========================================================= --}}
        @php
$daysRemaining = null;

if (
    $currentPackage &&
    $currentPackage['status'] === 'active' &&
    $currentPackage['expires_at']
) {
    $daysRemaining = now()->startOfDay()->diffInDays(
        $currentPackage['expires_at']->startOfDay(),
        false
    );
}

$canRenew = $daysRemaining !== null
    && $daysRemaining >= 0
    && $daysRemaining <= 7;
        @endphp


        {{-- ========================================================= --}}
        {{-- PAKET SAAT INI --}}
        {{-- ========================================================= --}}
        @if ($currentPackage)
                            <div
                                class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

                                {{-- Header --}}
                                <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                        {{-- Informasi Paket --}}
                                        <div>
                                            <div class="flex items-center gap-3">

                                                <h2 class="text-xl font-bold text-gray-950 dark:text-white">
                                                    {{ $currentPackage['name'] }}
                                                </h2>

                                                @if ($currentPackage['status'] === 'active')
                                                    <x-filament::badge color="success">
                                                        Aktif
                                                    </x-filament::badge>
                                                @elseif ($currentPackage['status'] === 'pending')
                                                    <x-filament::badge color="warning">
                                                        Menunggu Pembayaran
                                                    </x-filament::badge>
                                                @elseif ($currentPackage['status'] === 'expired')
                                                    <x-filament::badge color="gray">
                                                        Kedaluwarsa
                                                    </x-filament::badge>
                                                @elseif ($currentPackage['status'] === 'cancelled')
                                                    <x-filament::badge color="danger">
                                                        Dibatalkan
                                                    </x-filament::badge>
                                                @endif

                                            </div>

                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $currentPackage['description'] }}
                                            </p>
                                        </div>


                                        {{-- Harga + Tombol Perpanjang --}}
                                        <div class="text-left sm:text-right">

                                            @if ($currentPackage['price'] > 0)

                                                <div class="text-2xl font-bold text-gray-950 dark:text-white">
                                                    Rp {{ number_format($currentPackage['price'], 0, ',', '.') }}
                                                </div>

                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    per bulan
                                                </div>

                                                {{-- PERPANJANG LANGGANAN --}}
                                                @if ($canRenew)
                                                    <div class="mt-3">
                                                        <x-filament::button wire:click="openSubscribeModal" icon="heroicon-o-arrow-path"
                                                            color="primary" size="sm">
                                                            Perpanjang Langganan
                                                        </x-filament::button>
                                                    </div>
                                                @endif

                                            @else

                                                <div class="text-2xl font-bold text-gray-950 dark:text-white">
                                                    Gratis
                                                </div>

                                            @endif

                                        </div>

                                    </div>
                                </div>


                                {{-- ================================================= --}}
                                {{-- PENDING PAYMENT --}}
                                {{-- ================================================= --}}
                                @if ($currentPackage['status'] === 'pending')
                                    <div class="px-6 pt-6">
                                        <div class="rounded-xl bg-warning-50 p-4 ring-1 ring-warning-200 dark:bg-warning-500/10 dark:ring-warning-500/20">

                                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                                <div class="flex gap-3">

                                                    <x-heroicon-o-clock class="mt-0.5 h-5 w-5 shrink-0 text-warning-600 dark:text-warning-400" />

                                                    <div>
                                                        <h3 class="font-semibold text-warning-800 dark:text-warning-300">
                                                            Menunggu Pembayaran
                                                        </h3>

                                                        <p class="mt-1 text-sm leading-6 text-warning-700 dark:text-warning-400">
                                                            Pengajuan paket langganan Anda sudah dibuat.
                                                            Silakan lakukan pembayaran dan kirim bukti pembayaran
                                                            untuk proses verifikasi.
                                                        </p>
                                                    </div>

                                                </div>

                                                <div class="shrink-0 sm:pt-0.5">
                                                    <x-filament::button tag="a" href="{{ url('/admin/payment') }}" icon="heroicon-o-credit-card"
                                                        color="warning" size="sm">
                                                        Bayar Sekarang
                                                    </x-filament::button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endif


                                {{-- ================================================= --}}
                                {{-- USAGE --}}
                                {{-- ================================================= --}}
                                <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2">

                                    {{-- Kelas --}}
                                    <div class="rounded-xl bg-gray-50 p-5 dark:bg-white/5">

                                        <div class="flex items-center justify-between">

                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                Kelas
                                            </span>

                                            <x-heroicon-o-building-office-2 class="h-5 w-5 text-gray-400" />

                                        </div>

                                        <div class="mt-3 flex items-end justify-between">

                                            <div>

                                                <span class="text-2xl font-bold text-gray-950 dark:text-white">
                                                    {{ $currentPackage['used_classes'] }}
                                                </span>

                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    / {{ $currentPackage['class_limit'] }}
                                                </span>

                                            </div>

                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                digunakan
                                            </span>

                                        </div>

                                        @php
            $classPercentage = $currentPackage['class_limit'] > 0
                ? min(
                    100,
                    ($currentPackage['used_classes'] / $currentPackage['class_limit']) * 100
                )
                : 0;
                                        @endphp

                                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-gray-200 dark:bg-white/10">

                                            <div class="h-full rounded-full bg-primary-500" style="width: {{ $classPercentage }}%"></div>

                                        </div>

                                    </div>


                                    {{-- Siswa --}}
                                    <div class="rounded-xl bg-gray-50 p-5 dark:bg-white/5">

                                        <div class="flex items-center justify-between">

                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                Siswa
                                            </span>

                                            <x-heroicon-o-users class="h-5 w-5 text-gray-400" />

                                        </div>

                                        <div class="mt-3 flex items-end justify-between">

                                            <div>

                                                <span class="text-2xl font-bold text-gray-950 dark:text-white">
                                                    {{ $currentPackage['used_students'] }}
                                                </span>

                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    / {{ $currentPackage['student_limit'] }}
                                                </span>

                                            </div>

                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                digunakan
                                            </span>

                                        </div>

                                        @php
            $studentPercentage = $currentPackage['student_limit'] > 0
                ? min(
                    100,
                    ($currentPackage['used_students'] / $currentPackage['student_limit']) * 100
                )
                : 0;
                                        @endphp

                                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-gray-200 dark:bg-white/10">

                                            <div class="h-full rounded-full bg-primary-500" style="width: {{ $studentPercentage }}%"></div>

                                        </div>

                                    </div>

                                </div>


                                {{-- ================================================= --}}
                                {{-- PERIODE --}}
                                {{-- ================================================= --}}
                                @if ($currentPackage['status'] === 'active' && $currentPackage['price'] > 0)

                                    <div class="border-t border-gray-200 px-6 py-5 dark:border-white/10">

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                            {{-- Mulai --}}
                                            <div>

                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    Mulai Berlangganan
                                                </div>

                                                <div class="mt-1 font-medium text-gray-950 dark:text-white">
                                                    {{ $currentPackage['started_at']?->format('d M Y H:i') ?? '-' }}
                                                </div>

                                            </div>


                                            {{-- Masa Berlaku --}}
                                            <div>

                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    Masa Berlaku
                                                </div>

                                                <div class="mt-1 font-medium text-gray-950 dark:text-white">
                                                    {{ $currentPackage['expires_at']?->format('d M Y H:i') ?? '-' }}
                                                </div>

                                            </div>

                                        </div>


                                        {{-- Peringatan Masa Aktif --}}
                                        @if ($canRenew)

                                            <div
                                                class="mt-5 flex items-start gap-3 rounded-xl bg-amber-50 p-4 ring-1 ring-amber-200 dark:bg-amber-500/10 dark:ring-amber-500/20">

                                                <x-heroicon-o-clock class="mt-0.5 h-5 w-5 shrink-0 text-amber-600 dark:text-amber-400" />

                                                <div class="min-w-0">

                                                    <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">

                                                        @if ($daysRemaining === 0)
                                                            Masa aktif paket Anda berakhir hari ini.
                                                        @elseif ($daysRemaining === 1)
                                                            Masa aktif paket Anda berakhir besok.
                                                        @else
                                                            Masa aktif paket Anda tersisa {{ $daysRemaining }} hari.
                                                        @endif

                                                    </p>

                                                    <p class="mt-1 text-sm text-amber-700 dark:text-amber-400">
                                                        Perpanjang langganan agar akses GuruPro tetap aktif.
                                                    </p>

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                @endif

                            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- PAKET LANGGANAN --}}
        {{-- ========================================================= --}}
        @if ($subscriptionPackage)

            <div
                class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

                <div class="p-6 sm:p-8">

                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                        {{-- Informasi --}}
                        <div>

                            <div class="flex items-center gap-2">

                                <span
                                    class="rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold tracking-wide text-primary-700 ring-1 ring-primary-200 dark:bg-primary-500/10 dark:text-primary-400 dark:ring-primary-500/20">
                                    UPGRADE
                                </span>

                            </div>

                            <h2 class="mt-4 text-2xl font-bold text-gray-950 dark:text-white sm:text-3xl">
                                {{ $subscriptionPackage['name'] }}
                            </h2>

                            <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500 dark:text-gray-400">
                                {{ $subscriptionPackage['description'] }}
                            </p>

                            <div class="mt-5 flex items-baseline gap-2">

                                <span class="text-3xl font-bold text-gray-950 dark:text-white">
                                    Rp {{ number_format($subscriptionPackage['price'], 0, ',', '.') }}
                                </span>

                                @if ($subscriptionPackage['period'])

                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        / {{ $subscriptionPackage['period'] }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Button --}}
                        <div class="shrink-0">

                            <x-filament::button wire:click="openSubscribeModal" icon="heroicon-o-arrow-up-circle"
                                color="primary" size="lg">
                                Berlangganan Sekarang
                            </x-filament::button>

                        </div>

                    </div>


                    {{-- Features --}}
                    <div
                        class="mt-8 grid grid-cols-1 gap-3 border-t border-gray-200 pt-6 dark:border-white/10 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach ($subscriptionPackage['features'] as $feature)

                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">

                                <x-heroicon-o-check-circle class="h-5 w-5 shrink-0 text-primary-500" />

                                <span>
                                    {{ $feature }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- MODAL BERLANGGANAN --}}
        {{-- ========================================================= --}}
        @if ($showSubscribeModal)

            <div x-data x-init="$nextTick(() => document.body.classList.add('overflow-hidden'))"
                x-on:keydown.escape.window="$wire.closeSubscribeModal()"
                class="fixed inset-0 z-50 flex items-center justify-center p-4">

                {{-- Backdrop --}}
                <div class="absolute inset-0 bg-gray-950/50 backdrop-blur-sm" wire:click="closeSubscribeModal"></div>


                {{-- Modal --}}
                <div class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900">

                    {{-- Header --}}
                    <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                                <x-heroicon-o-arrow-up-circle class="h-6 w-6" />
                            </div>

                            <div>

                                <h2 class="text-lg font-bold text-gray-950 dark:text-white">
                                    Konfirmasi Berlangganan
                                </h2>

                                <p class="mt-1 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                    Apakah Anda yakin ingin berlangganan paket Langganan GuruPro?
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Content --}}
                    <div class="px-6 py-5">

                        <div
                            class="rounded-xl border border-primary-100 bg-primary-50/70 p-4 dark:border-primary-500/10 dark:bg-primary-500/5">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Paket Langganan
                                </span>

                                <span class="font-bold text-gray-950 dark:text-white">
                                    Rp29.000
                                </span>

                            </div>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Per bulan
                            </p>

                        </div>


                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            Setelah dikonfirmasi, pengajuan langganan akan dibuat dan
                            menunggu pembayaran serta verifikasi admin.
                        </p>

                    </div>


                    {{-- Footer --}}
                    <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4 dark:border-gray-800">

                        <x-filament::button color="gray" wire:click="closeSubscribeModal">
                            Batal
                        </x-filament::button>

                        <x-filament::button color="primary" icon="heroicon-o-arrow-right" wire:click="subscribe"
                            wire:loading.attr="disabled">

                            <span wire:loading.remove wire:target="subscribe">
                                Lanjutkan
                            </span>

                            <span wire:loading wire:target="subscribe">
                                Memproses...
                            </span>

                        </x-filament::button>

                    </div>

                </div>

            </div>

        @endif

    </div>

</x-filament-panels::page>