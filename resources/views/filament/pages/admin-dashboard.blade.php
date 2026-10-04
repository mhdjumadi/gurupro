<x-filament-panels::page>

    {{-- Header --}}
    {{-- <div class="mb-2">
        <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
            Dashboard Admin
        </h1>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Ringkasan kondisi dan aktivitas GuruPro.
        </p>
    </div> --}}


    {{-- ========================================================= --}}
    {{-- STATISTIK UTAMA --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Guru --}}
        <div
            class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Guru
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-950 dark:text-white">
                            {{ number_format($stats['totalTeachers'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                        <x-heroicon-o-user-group class="h-6 w-6" />

                    </div>

                </div>

                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    <span class="font-medium text-success-600 dark:text-success-400">
                        +{{ $stats['newTeachersThisMonth'] }}
                    </span>
                    guru baru bulan ini
                </div>

            </div>
        </div>


        {{-- Siswa --}}
        <div
            class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Siswa
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-950 dark:text-white">
                            {{ number_format($stats['totalStudents'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-info-50 text-info-600 dark:bg-info-500/10 dark:text-info-400">

                        <x-heroicon-o-academic-cap class="h-6 w-6" />

                    </div>

                </div>

                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    Siswa terdaftar di GuruPro
                </div>

            </div>
        </div>


        {{-- Kelas --}}
        <div
            class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Kelas
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-950 dark:text-white">
                            {{ number_format($stats['totalClasses'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50 text-warning-600 dark:bg-warning-500/10 dark:text-warning-400">

                        <x-heroicon-o-building-office-2 class="h-6 w-6" />

                    </div>

                </div>

                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    Total kelas yang dibuat guru
                </div>

            </div>
        </div>


        {{-- Subscription --}}
        <div
            class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Subscription Aktif
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-950 dark:text-white">
                            {{ number_format($stats['activeSubscriptions'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-success-50 text-success-600 dark:bg-success-500/10 dark:text-success-400">

                        <x-heroicon-o-credit-card class="h-6 w-6" />

                    </div>

                </div>

                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    Paket berbayar yang sedang aktif
                </div>

            </div>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ALERT SUBSCRIPTION --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        {{-- Pending --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="flex items-center gap-4 p-5">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-warning-50 text-warning-600 dark:bg-warning-500/10 dark:text-warning-400">

                    <x-heroicon-o-clock class="h-6 w-6" />

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Menunggu Pembayaran
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-950 dark:text-white">
                        {{ number_format($stats['pendingSubscriptions'], 0, ',', '.') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Akan Expired --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="flex items-center gap-4 p-5">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-warning-50 text-warning-600 dark:bg-warning-500/10 dark:text-warning-400">

                    <x-heroicon-o-exclamation-triangle class="h-6 w-6" />

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Akan Berakhir
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-950 dark:text-white">
                        {{ number_format($stats['expiringSubscriptions'], 0, ',', '.') }}
                    </p>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Dalam 7 hari
                    </p>

                </div>

            </div>

        </div>


        {{-- Expired --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="flex items-center gap-4 p-5">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-danger-50 text-danger-600 dark:bg-danger-500/10 dark:text-danger-400">

                    <x-heroicon-o-x-circle class="h-6 w-6" />

                </div>

                <div class="min-w-0">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Subscription Expired
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-950 dark:text-white">
                        {{ number_format($stats['expiredSubscriptions'], 0, ',', '.') }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SUBSCRIPTION PENDING --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

        <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-base font-semibold text-gray-950 dark:text-white">
                        Menunggu Pembayaran
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Pengajuan subscription yang perlu ditindaklanjuti.
                    </p>
                </div>

                @if ($stats['pendingSubscriptions'] > 0)
                    <x-filament::badge color="warning">
                        {{ $stats['pendingSubscriptions'] }} pengajuan
                    </x-filament::badge>
                @endif

            </div>

        </div>

        @if ($pendingSubscriptionList->isNotEmpty())

            <div class="divide-y divide-gray-200 dark:divide-white/10">

                @foreach ($pendingSubscriptionList as $subscription)

                    <div class="flex items-center justify-between gap-4 px-6 py-4">

                        <div class="min-w-0">

                            <p class="truncate text-sm font-semibold text-gray-950 dark:text-white">
                                {{ $subscription->user?->name ?? 'User' }}
                            </p>

                            <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-400">
                                {{ $subscription->user?->email }}
                            </p>

                        </div>

                        <div class="shrink-0 text-right">

                            <p class="text-sm font-medium text-gray-950 dark:text-white">
                                {{ $subscription->package?->name ?? 'Paket' }}
                            </p>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Rp {{ number_format($subscription->price, 0, ',', '.') }}
                            </p>

                        </div>

                        <x-filament::badge color="warning">
                            Pending
                        </x-filament::badge>

                    </div>

                @endforeach

            </div>

        @else

            <div class="px-6 py-10 text-center">

                <x-heroicon-o-check-circle class="mx-auto h-10 w-10 text-success-500" />

                <p class="mt-3 text-sm font-medium text-gray-950 dark:text-white">
                    Tidak ada pengajuan pending
                </p>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Semua pengajuan subscription sudah ditangani.
                </p>

            </div>

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- 2 KOLOM: GURU TERBARU + SUBSCRIPTION AKAN EXPIRED --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">


        {{-- Guru terbaru --}}
        <div
            class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

                <h2 class="text-base font-semibold text-gray-950 dark:text-white">
                    Guru Terbaru
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Guru yang baru terdaftar di GuruPro.
                </p>

            </div>

            @if ($latestTeachers->isNotEmpty())

                <div class="divide-y divide-gray-200 dark:divide-white/10">

                    @foreach ($latestTeachers as $teacher)

                        <div class="flex items-center gap-4 px-6 py-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-100 text-sm font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">

                                {{ str($teacher->name)->substr(0, 1)->upper() }}

                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-semibold text-gray-950 dark:text-white">
                                    {{ $teacher->name }}
                                </p>

                                <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-400">
                                    {{ $teacher->school ?: $teacher->email }}
                                </p>

                            </div>

                            <div class="shrink-0 text-right">

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $teacher->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                    Belum ada guru.
                </div>

            @endif

        </div>


        {{-- Subscription akan expired --}}
        <div
            class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <h2 class="text-base font-semibold text-gray-950 dark:text-white">
                            Akan Berakhir
                        </h2>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Subscription yang berakhir dalam 7 hari.
                        </p>

                    </div>

                    @if ($stats['expiringSubscriptions'] > 0)

                        <x-filament::badge color="warning">
                            {{ $stats['expiringSubscriptions'] }}
                        </x-filament::badge>

                    @endif

                </div>

            </div>

            @if ($expiringSubscriptionList->isNotEmpty())

                <div class="divide-y divide-gray-200 dark:divide-white/10">

                    @foreach ($expiringSubscriptionList as $subscription)

                        <div class="flex items-center gap-4 px-6 py-4">

                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-semibold text-gray-950 dark:text-white">
                                    {{ $subscription->user?->name ?? 'User' }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $subscription->package?->name ?? 'Paket' }}
                                </p>

                            </div>

                            <div class="shrink-0 text-right">

                                <p class="text-sm font-semibold text-warning-600 dark:text-warning-400">
                                    {{ $subscription->expires_at->diffForHumans() }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $subscription->expires_at->format('d M Y') }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="px-6 py-10 text-center">

                    <x-heroicon-o-check-circle class="mx-auto h-10 w-10 text-success-500" />

                    <p class="mt-3 text-sm font-medium text-gray-950 dark:text-white">
                        Tidak ada subscription yang akan berakhir
                    </p>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Dalam 7 hari ke depan.
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SUBSCRIPTION TERBARU --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

        <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

            <h2 class="text-base font-semibold text-gray-950 dark:text-white">
                Subscription Terbaru
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Aktivitas subscription terbaru di GuruPro.
            </p>

        </div>

        @if ($latestSubscriptions->isNotEmpty())

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="border-b border-gray-200 dark:border-white/10">

                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Guru
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Paket
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Harga
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Status
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Tanggal
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-white/10">

                        @foreach ($latestSubscriptions as $subscription)

                            <tr class="transition hover:bg-gray-50 dark:hover:bg-white/5">

                                <td class="px-6 py-4">

                                    <div>
                                        <p class="text-sm font-medium text-gray-950 dark:text-white">
                                            {{ $subscription->user?->name ?? 'User' }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $subscription->user?->email }}
                                        </p>
                                    </div>

                                </td>

                                <td class="px-6 py-4">

                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $subscription->package?->name ?? 'Paket' }}
                                    </span>

                                </td>

                                <td class="px-6 py-4">

                                    <span class="text-sm font-medium text-gray-950 dark:text-white">
                                        Rp {{ number_format($subscription->price, 0, ',', '.') }}
                                    </span>

                                </td>

                                <td class="px-6 py-4">

                                    @php
                                        $statusColor = match ($subscription->status) {
                                            'active' => 'success',
                                            'pending' => 'warning',
                                            'expired' => 'danger',
                                            'cancelled' => 'gray',
                                            default => 'gray',
                                        };

                                        $statusLabel = match ($subscription->status) {
                                            'active' => 'Aktif',
                                            'pending' => 'Menunggu Pembayaran',
                                            'expired' => 'Kedaluwarsa',
                                            'cancelled' => 'Dibatalkan',
                                            default => ucfirst($subscription->status),
                                        };
                                    @endphp

                                    <x-filament::badge :color="$statusColor">
                                        {{ $statusLabel }}
                                    </x-filament::badge>

                                </td>

                                <td class="px-6 py-4">

                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $subscription->created_at->format('d M Y') }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                Belum ada data subscription.
            </div>

        @endif

    </div>

</x-filament-panels::page>
