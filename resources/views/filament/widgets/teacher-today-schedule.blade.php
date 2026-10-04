<x-filament-widgets::widget>
    <x-filament::section class="overflow-hidden">
        {{-- HEADER --}}
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                        <x-heroicon-o-calendar-days class="h-5 w-5" />
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-gray-950 dark:text-white">Jadwal Mengajar Hari Ini</h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ \App\Support\DateFormatter::indonesia(now()) }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- JUMLAH JADWAL --}}
            <div
                class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                {{ count($this->getSchedules()) }} Jadwal
            </div>
        </div>

        {{-- SCHEDULE LIST --}}
        <div class="mt-6 space-y-1">
            @forelse ($this->getSchedules() as $schedule)

                <div
    class="group flex gap-4 rounded-2xl border border-gray-300 p-4 transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-white/5">

    {{-- TIME --}}
    <div class="flex w-16 shrink-0 flex-col items-center pt-1">
        <div class="text-sm font-bold leading-none text-gray-950 dark:text-white">
            {{ $schedule['start'] }}
        </div>

        <div class="my-1.5 h-5 w-px bg-gray-300 dark:bg-gray-700"></div>

        <div class="text-xs font-medium leading-none text-gray-400 dark:text-gray-500">
            {{ $schedule['end'] }}
        </div>
    </div>

    {{-- TIMELINE --}}
    <div class="relative flex w-4 shrink-0 justify-center">
        <div class="absolute top-0 bottom-0 w-px bg-gray-300 dark:bg-gray-700"></div>

        <div
            class="relative z-10 mt-1 h-3 w-3 rounded-full bg-primary-500 ring-4 ring-primary-50 dark:ring-primary-500/10">
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="min-w-0 flex-1">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div class="min-w-0">

                {{-- SUBJECT --}}
                <div class="truncate text-base font-semibold text-gray-950 dark:text-white">
                    {{ $schedule['subject'] }}
                </div>

                {{-- CLASS + ROOM --}}
                <div class="mt-2 flex flex-wrap items-center gap-2">

                    {{-- CLASS --}}
                    <span
                        class="inline-flex items-center rounded-lg border border-primary-100 bg-primary-50 px-2.5 py-1 text-xs font-semibold text-primary-700 dark:border-primary-500/20 dark:bg-primary-500/10 dark:text-primary-400">
                        {{ $schedule['class'] }}
                    </span>

                    <span class="text-xs text-gray-300 dark:text-gray-700">
                        •
                    </span>

                    {{-- ROOM --}}
                    <span
                        class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 dark:text-gray-400">
                        <x-heroicon-m-building-office-2 class="h-3.5 w-3.5" />

                        {{ $schedule['room'] ?? '-' }}
                    </span>

                </div>
            </div>

            {{-- ACTION --}}
            <div class="shrink-0">
                @if ($schedule['has_journal'])

                    <x-filament::button
                        size="sm"
                        color="gray"
                        icon="heroicon-m-check-circle"
                        icon-position="before"
                        tag="a"
                        :href="\App\Filament\Resources\TeachingJournals\TeachingJournalResource::getUrl('view', [
                            'record' => $schedule['journal_id'],
                        ])">
                        Jurnal Sudah Dibuat
                    </x-filament::button>

                @else

                    <x-filament::button
                        size="sm"
                        icon="heroicon-m-plus"
                        tag="a"
                        :href="\App\Filament\Resources\TeachingJournals\TeachingJournalResource::getUrl('create', [
                            'schedule_id' => $schedule['id'],
                        ])">
                        Buat Jurnal
                    </x-filament::button>

                @endif
            </div>

        </div>
    </div>
</div>

            @empty {{-- EMPTY STATE --}}
                <div
                    class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center dark:border-gray-700">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-gray-800">
                        <x-heroicon-o-calendar-days class="h-6 w-6" />
                    </div>

                    <h3 class="mt-4 text-sm font-semibold text-gray-950 dark:text-white">Tidak ada jadwal mengajar</h3>

                    <p class="mt-1 max-w-sm text-sm text-gray-500 dark:text-gray-400">
                        Tidak ada jadwal mengajar yang tercatat untuk hari ini.
                    </p>
                </div>

            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>