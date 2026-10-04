<x-filament-widgets::widget>
    <x-filament::section class="overflow-hidden">
        @php $journals = $this->getJournals(); @endphp {{-- HEADER --}}
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400"
                    >
                        <x-heroicon-o-book-open class="h-5 w-5" />
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-gray-950 dark:text-white">Jurnal Mengajar Terbaru</h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400">Riwayat jurnal pembelajaran Anda</p>
                    </div>
                </div>
            </div>

            {{-- LIHAT SEMUA --}}
            <a href="{{ \App\Filament\Resources\TeachingJournals\TeachingJournalResource::getUrl('index') }}"
                class="group inline-flex items-center gap-1 text-sm font-medium text-primary-600 transition-colors duration-200 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300">
                <span>Lihat Semua</span>
            
                <x-heroicon-m-arrow-right class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" />
            </a>
        </div>

        {{-- JOURNAL LIST --}}
        <div class="mt-6 space-y-1">
            @forelse ($journals as $journal) @php $schedule = $journal->schedule;
    $subject = $schedule?->subject?->name
        ?? '-';
    $class = $schedule?->class?->name ?? '-';
    $material = $journal->material ?
        \Illuminate\Support\Str::limit(trim(strip_tags($journal->material)), 90) : 'Tidak ada materi yang
                                        dicatat.';
    $date = $journal->date ? \Carbon\Carbon::parse($journal->date) : null;
    $startTime =
        $journal->start_time ? \Carbon\Carbon::parse($journal->start_time)->format('H:i') : null;
    $endTime =
        $journal->end_time ? \Carbon\Carbon::parse($journal->end_time)->format('H:i') : null; @endphp {{-- JOURNAL
                                        
                            {{--ITEM --}}
                            <div class="group flex items-center gap-4 border-b border-gray-200 py-4 last:border-0 dark:border-gray-700">
                                {{-- DATE --}}
                                <div class="w-12 shrink-0 text-center">
                                    @if ($date)
                                        <div class="text-xs font-medium uppercase text-gray-400">
                                            {{ $date->translatedFormat('M') }}
                                        </div>

                                        <div class="text-xl font-bold text-gray-900 dark:text-white">
                                            {{ $date->format('d') }}
                                        </div>
                                    @else
                                        <x-heroicon-o-calendar-days class="mx-auto h-5 w-5 text-gray-400" />
                                    @endif
                                </div>

                                {{-- CONTENT --}}
                                <div class="min-w-0 flex-1">
                                    <div class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $subject }}
                                    </div>

                                    <div class="mt-1 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span>{{ $class }}</span>

                                        @if ($startTime && $endTime)
                                            <span>•</span>
                                            <span class="inline-flex items-center gap-1">
                                                <x-heroicon-m-clock class="h-3.5 w-3.5" />
                                                {{ $startTime }} – {{ $endTime }}
                                            </span>
                                        @endif
                                    </div>

                                    @if ($material)
                                        <div class="mt-1.5 flex items-center gap-1.5">
                                            <x-heroicon-m-document-text class="h-3.5 w-3.5 shrink-0 text-gray-400" />

                                            <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                                                {{ $material }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                {{-- DETAIL --}}
                                <a href="{{ \App\Filament\Resources\TeachingJournals\TeachingJournalResource::getUrl('view', [
        'record' => $journal,
    ]) }}"
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-primary-600 dark:hover:bg-white/10"
                                    title="Lihat detail">
                                    <x-heroicon-m-chevron-right class="h-5 w-5" />
                                </a>
                            </div>

            @empty {{-- EMPTY STATE --}}
            <div
                class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center dark:border-gray-700"
            >
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-gray-800"
                >
                    <x-heroicon-o-book-open class="h-6 w-6" />
                </div>

                <h3 class="mt-4 text-sm font-semibold text-gray-950 dark:text-white">Belum ada jurnal</h3>

                <p class="mt-1 max-w-sm text-sm text-gray-500 dark:text-gray-400">
                    Jurnal mengajar yang Anda buat akan muncul di sini.
                </p>

                <x-filament::button
                    class="mt-5"
                    size="sm"
                    icon="heroicon-m-plus"
                    tag="a"
                    :href="\App\Filament\Resources\TeachingJournals\TeachingJournalResource::getUrl('create')"
                >
                    Buat Jurnal
                </x-filament::button>
            </div>

            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
