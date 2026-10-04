<x-filament-panels::page>
    {{-- SUBSCRIPTION / PAYMENT WARNING --}}
    @if ($showPaymentWarning || $showExpiryWarning)

        {{-- PAYMENT WARNING --}}
        @if ($showPaymentWarning)
            <div
                class="relative mb-6 overflow-hidden rounded-2xl border border-blue-200 bg-blue-50/80 shadow-sm dark:border-blue-500/20 dark:bg-blue-950/30">

                {{-- Decorative --}}
                <div
                    class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-blue-300/20 blur-3xl dark:bg-blue-500/10">
                </div>

                <div class="relative flex items-start gap-3 p-4 sm:p-5">

                    {{-- ICON --}}
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <x-heroicon-o-credit-card class="h-5 w-5" />
                    </div>

                    {{-- CONTENT --}}
                    <div class="min-w-0 flex-1 pr-8">

                        <p class="text-sm font-bold text-blue-900 dark:text-blue-300">
                            Anda memiliki tagihan yang belum dibayar.
                        </p>

                        <p class="mt-1 text-sm leading-relaxed text-blue-800/80 dark:text-blue-400/80">
                            Anda telah mengajukan paket subscription.
                            Silakan selesaikan pembayaran agar paket dapat diproses.
                        </p>

                        <a href="{{ url('/admin/payment') }}"
                            class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 transition hover:text-blue-900 hover:underline dark:text-blue-300 dark:hover:text-blue-200">

                            Bayar Sekarang

                            <x-heroicon-m-arrow-right class="h-4 w-4" />
                        </a>

                    </div>

                    {{-- CLOSE --}}
                    <button type="button" wire:click="closePaymentWarning"
                        class="absolute right-3 top-3 rounded-lg p-1.5 text-blue-600 transition hover:bg-blue-100 hover:text-blue-900 dark:text-blue-400 dark:hover:bg-blue-900/40 dark:hover:text-blue-200"
                        title="Tutup">

                        <x-heroicon-o-x-mark class="h-5 w-5" />

                    </button>

                </div>
            </div>

            {{-- EXPIRY WARNING --}}
        @elseif ($showExpiryWarning)

            <div
                class="relative mb-6 overflow-hidden rounded-2xl border border-amber-200 bg-amber-50/80 shadow-sm dark:border-amber-500/20 dark:bg-amber-950/30">

                {{-- Decorative --}}
                <div
                    class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-amber-300/20 blur-3xl dark:bg-amber-500/10">
                </div>

                <div class="relative flex items-start gap-3 p-4 sm:p-5">

                    {{-- ICON --}}
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                        <x-heroicon-o-clock class="h-5 w-5" />
                    </div>

                    {{-- CONTENT --}}
                    <div class="min-w-0 flex-1 pr-8">

                        <p class="text-sm font-bold text-amber-900 dark:text-amber-300">
                            @if ($daysRemaining === 0)
                                Masa aktif paket Anda berakhir hari ini.
                            @elseif ($daysRemaining === 1)
                                Masa aktif paket Anda berakhir besok.
                            @else
                                Masa aktif paket Anda akan berakhir dalam
                                {{ $daysRemaining }} hari.
                            @endif
                        </p>

                        <p class="mt-1 text-sm leading-relaxed text-amber-800/80 dark:text-amber-400/80">
                            Perpanjang paket agar Anda tetap dapat menggunakan GuruPro.
                        </p>

                        <a href="{{ url('/admin/package') }}"
                            class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-amber-700 transition hover:text-amber-900 hover:underline dark:text-amber-300 dark:hover:text-amber-200">

                            Perpanjang Paket

                            <x-heroicon-m-arrow-right class="h-4 w-4" />

                        </a>

                    </div>

                    {{-- CLOSE --}}
                    <button type="button" wire:click="closeExpiryWarning"
                        class="absolute right-3 top-3 rounded-lg p-1.5 text-amber-600 transition hover:bg-amber-100 hover:text-amber-900 dark:text-amber-400 dark:hover:bg-amber-900/40 dark:hover:text-amber-200"
                        title="Tutup">

                        <x-heroicon-o-x-mark class="h-5 w-5" />

                    </button>

                </div>
            </div>

        @endif

    @endif


    {{-- WELCOME HEADER --}}
    <div
        class="relative mb-6 overflow-hidden rounded-2xl border border-primary-100 bg-linier-to-br from-primary-50 via-white to-white shadow-sm dark:border-primary-500/10 dark:from-primary-950/50 dark:via-gray-900 dark:to-gray-900">

        {{-- DECORATIVE BACKGROUND --}}
        <div
            class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-primary-300/20 blur-3xl dark:bg-primary-500/10">
        </div>

        <div
            class="pointer-events-none absolute -bottom-24 left-1/3 h-56 w-56 rounded-full bg-primary-200/20 blur-3xl dark:bg-primary-500/5">
        </div>


        {{-- MAIN CONTENT --}}
        <div class="relative p-6 sm:p-8">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- LEFT --}}
                <div class="min-w-0">

                    {{-- SCHOOL --}}
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-primary-600 dark:text-primary-400">
                        {{ auth()->user()->school ?? 'Nama Sekolah' }}
                    </p>


                    {{-- GREETING --}}
                    <div class="mt-3 flex items-start gap-4">

                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">

                                <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                                    Selamat datang,
                                    {{ auth()->user()->name }}
                                </h1>

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-primary-100 px-2.5 py-1 text-xs font-bold text-primary-700 dark:bg-primary-500/15 dark:text-primary-300">

                                    <x-heroicon-s-academic-cap class="h-3.5 w-3.5" />

                                    Guru

                                </span>

                            </div>

                            <p
                                class="mt-2 max-w-xl text-sm leading-relaxed text-gray-600 dark:text-gray-400 sm:text-[15px]">
                                Siap menginspirasi hari ini?
                                Kelola kegiatan mengajar Anda dengan lebih mudah bersama GuruPro.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- DATE --}}
                <div class="shrink-0">

                    <div
                        class="flex items-center gap-3 rounded-2xl border border-primary-100/80 bg-white/70 px-4 py-3 shadow-sm backdrop-blur-sm dark:border-primary-500/10 dark:bg-gray-800/60">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">

                            <x-heroicon-o-calendar-days class="h-5 w-5" />

                        </div>

                        <div>

                            <p
                                class="text-[10px] font-bold uppercase tracking-[0.18em] text-primary-600 dark:text-primary-400">
                                Hari ini
                            </p>

                            <p class="mt-1 whitespace-nowrap text-sm font-bold text-gray-800 dark:text-gray-200">
                                {{ \App\Support\DateFormatter::indonesia(now()) }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    @php
$user = auth()->user();

$hasClasses = $user->hasClasses();
$hasStudents = $user->hasStudents();
    @endphp
    
    @if (!$hasClasses || !$hasStudents)

        {{-- SETUP AWAL --}}
        <div class="mb-6">
            <x-filament::section>
                <div class="flex flex-col items-center justify-center py-8 text-center">

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                                    bg-primary-50 text-primary-600
                                    dark:bg-primary-500/10 dark:text-primary-400">
                        <x-heroicon-o-academic-cap class="h-7 w-7" />
                    </div>

                    <h2 class="mt-4 text-lg font-bold text-gray-950 dark:text-white">
                        Selamat datang di GuruPro 👋
                    </h2>

                    <p class="mt-2 max-w-lg text-sm leading-6 text-gray-500 dark:text-gray-400">
                        Sebelum mulai menggunakan fitur pembelajaran,
                        silakan siapkan kelas dan data siswa terlebih dahulu.
                    </p>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">

                        @if (!$hasClasses)

                            <x-filament::button tag="a"
                                href="{{ \App\Filament\Resources\Classes\ClassesResource::getUrl('create') }}"
                                icon="heroicon-m-plus">
                                Buat Kelas
                            </x-filament::button>

                        @endif

                    </div>

                </div>
            </x-filament::section>
        </div>

    @else

        {{-- STATISTICS --}}
        <div class="mb-6">
            @livewire(\App\Filament\Widgets\TeacherAssistantStats::class)
        </div>

        {{-- CURRENT SCHEDULE --}}
        <div class="mb-6">
            @livewire(\App\Filament\Widgets\TeacherCurrentSchedule::class)
        </div>

        {{-- TODAY SCHEDULE + LATEST JOURNALS --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            <div class="min-w-0">
                @livewire(\App\Filament\Widgets\TeacherTodaySchedule::class)
            </div>

            <div class="min-w-0">
                @livewire(\App\Filament\Widgets\TeacherLatestJournals::class)
            </div>

        </div>

    @endif

</x-filament-panels::page>