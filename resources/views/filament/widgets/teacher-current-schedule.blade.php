<x-filament-widgets::widget>
    <x-filament::section>
        @php
$schedule = $this->getCurrentSchedule();
        @endphp

        {{-- HEADER --}}
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl
                           bg-primary-50 text-primary-600
                           dark:bg-primary-500/10 dark:text-primary-400">
                    <x-heroicon-o-calendar-days class="h-5 w-5" />
                </div>

                <div>
                    <h2 class="text-base font-semibold text-gray-950 dark:text-white">
                        Jadwal Saat Ini
                    </h2>

                    <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                        {{ \App\Support\DateFormatter::indonesia(now(), 'l, d F Y') }}
                    </p>
                </div>
            </div>

            {{-- JAM --}}
            <div class="flex items-center gap-2.5">
                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                    <x-heroicon-o-clock class="h-4.5 w-4.5" />
                </div>
            
                <div class="text-right">
                    <div x-data="{ time: '' }" x-init="
                            const updateTime = () => {
                                time = new Date().toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    hour12: false
                                });
                            };
                
                            updateTime();
                            setInterval(updateTime, 1000);
                        " x-text="time"
                        class="text-lg font-semibold leading-none tabular-nums tracking-tight text-gray-900 dark:text-white"></div>
                
                    <div class="mt-1 text-[10px] font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Waktu saat ini
                    </div>
                </div>
            </div>
        </div>


        @if ($schedule)

            {{-- JADWAL AKTIF --}}
            <div class="relative mt-5 overflow-hidden rounded-2xl border border-primary-100
                       bg-linier-to-br from-primary-50 via-white to-white p-5
                       dark:border-primary-500/20 dark:from-primary-500/10
                       dark:via-gray-900 dark:to-gray-900">
                {{-- Dekorasi --}}
                <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full
                           bg-primary-100/50 blur-2xl
                           dark:bg-primary-500/10"></div>

                <div class="relative">

                    {{-- STATUS --}}
                    <div class="flex items-center justify-between gap-3">
                        <span class="inline-flex items-center gap-1.5 rounded-full
                                   bg-success-100 px-2.5 py-1 text-xs font-semibold
                                   text-success-700
                                   dark:bg-success-500/10 dark:text-success-400">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping
                                           rounded-full bg-success-400 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-success-500"></span>
                            </span>

                            Sedang Berlangsung
                        </span>

                        {{-- JAM PELAJARAN --}}
                        <div class="flex items-center gap-1.5 text-sm font-semibold
                                   text-gray-600 dark:text-gray-300">
                            <x-heroicon-o-clock class="h-4 w-4 text-primary-500" />

                            <span>
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                            </span>

                            <span class="text-gray-400">—</span>

                            <span>
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </span>
                        </div>
                    </div>


                    {{-- MAPEL --}}
                    <div class="mt-5">
                        <h3 class="text-xl font-bold tracking-tight
                                   text-gray-950 dark:text-white">
                            {{ $schedule->subject?->name ?? 'Mata Pelajaran' }}
                        </h3>

                        {{-- KELAS --}}
                        <div class="mt-2 flex items-center gap-2
                                   text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg
                                       bg-white text-primary-600 shadow-sm
                                       ring-1 ring-gray-200
                                       dark:bg-gray-800 dark:text-primary-400 dark:ring-gray-700">
                                <x-heroicon-o-academic-cap class="h-4 w-4" />
                            </div>

                            <span class="font-medium">
                                {{ $schedule->class?->name ?? 'Kelas' }}
                            </span>
                        </div>
                    </div>


                    {{-- PEMISAH --}}
                    <div class="my-5 border-t border-primary-100 dark:border-gray-700"></div>


                    {{-- STATUS JURNAL --}}
                    @if ($this->hasJournal($schedule))

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                               bg-success-100 text-success-600
                                               dark:bg-success-500/10 dark:text-success-400">
                                    <x-heroicon-m-check-circle class="h-5 w-5" />
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        Jurnal sudah dibuat
                                    </p>

                                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                        Jurnal kelas ini sudah tercatat hari ini.
                                    </p>
                                </div>
                            </div>

                            <x-heroicon-m-check class="h-5 w-5 text-success-500" />
                        </div>

                    @else

                                                            <div class="flex items-center justify-between gap-4">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                                                                   bg-warning-100 text-warning-600
                                                                                   dark:bg-warning-500/10 dark:text-warning-400">
                                                                        <x-heroicon-m-document-text class="h-5 w-5" />
                                                                    </div>

                                                                    <div>
                                                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                                            Jurnal belum diisi!
                                                                        </p>

                                                                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                                                            Silakan isi jurnal pembelajaran.
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <x-filament::button size="sm" icon="heroicon-m-arrow-right" icon-position="after" tag="a"
                                                                    :href="\App\Filament\Resources\TeachingJournals\TeachingJournalResource::getUrl('create', [
                            'schedule_id' => $schedule->id,
                        ])">
                                                                    Isi Jurnal
                                                                </x-filament::button>
                                                            </div>

                    @endif

                </div>
            </div>

        @else

            {{-- TIDAK ADA JADWAL --}}
            <div class="mt-5 flex flex-col items-center justify-center
                           rounded-xl border border-dashed border-gray-200
                           px-6 py-7 text-center
                           dark:border-gray-700">
                <div class="flex h-11 w-11 items-center justify-center rounded-full
                               bg-gray-100 text-gray-400
                               dark:bg-gray-800 dark:text-gray-500">
                    <x-heroicon-o-calendar-days class="h-5 w-5" />
                </div>

                <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">
                    Tidak ada jadwal saat ini
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada jadwal mengajar yang sedang berlangsung.
                </p>
            </div>

        @endif
    </x-filament::section>
</x-filament-widgets::widget>