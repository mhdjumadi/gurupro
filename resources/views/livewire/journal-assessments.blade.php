<div class="space-y-4">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-950 dark:text-white">📊 Penilaian</h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">Nilai siswa berdasarkan penilaian pada jurnal ini.</p>
        </div>

        @if ($assessmentNames->isNotEmpty())

            <button type="button" wire:click="openAddForm"
                class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-500">
                <x-heroicon-m-plus class="h-4 w-4" />
                Tambah Penilaian
            </button>

        @endif
    </div>

    {{-- FORM TAMBAH PENILAIAN --}} @if ($showAddForm)

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="mb-4">
                <h3 class="font-semibold text-gray-950 dark:text-white">Tambah Penilaian</h3>

                <p class="text-sm text-gray-500">Penilaian akan dibuat untuk seluruh siswa di kelas ini.</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300"> Nama Penilaian </label>

                <input type="text" wire:model="assessmentName" wire:keydown.enter="addAssessment"
                    placeholder="Contoh: Tugas 1"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800" />

                @error('assessmentName')
                    <p class="text-sm text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4 flex justify-end gap-2">
                <button type="button" wire:click="cancelAdd"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
                    Batal
                </button>

                <button type="button" wire:click="addAssessment" wire:loading.attr="disabled"
                    class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-500">
                    <span wire:loading.remove wire:target="addAssessment"> Simpan </span>

                    <span wire:loading wire:target="addAssessment"> Menyimpan... </span>
                </button>
            </div>
        </div>

    @endif {{-- BELUM ADA PENILAIAN --}} @if ($assessmentNames->isEmpty() && !$showAddForm)

        <div
            class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-6 py-10 text-center dark:border-gray-700 dark:bg-gray-900/50">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                <x-heroicon-o-clipboard-document-list class="h-7 w-7 text-gray-500" />
            </div>

            <h3 class="text-base font-semibold text-gray-950 dark:text-white">Belum ada penilaian</h3>

            <p class="mx-auto mt-1 max-w-md text-sm text-gray-500 dark:text-gray-400">
                Tambahkan penilaian jika pada jurnal ini ada tugas, kuis, atau bentuk penilaian lainnya.
            </p>

            <button type="button" wire:click="openAddForm"
                class="mt-5 inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-500">
                <x-heroicon-m-plus class="h-4 w-4" />
                Tambah Penilaian
            </button>
        </div>

    @endif {{-- TABEL PENILAIAN --}} @if ($assessmentNames->isNotEmpty())

        <div
            class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3 font-semibold">NISN</th>

                        <th class="whitespace-nowrap px-4 py-3 font-semibold">Nama Siswa</th>

                        @foreach ($assessmentNames as $assessmentName)

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold">
                                <div class="flex items-center justify-center gap-2">
                                    <span> {{ $assessmentName }} </span>

                                    <button type="button" wire:click="confirmDelete(@js($assessmentName))"
                                        class="rounded-md p-1 text-danger-500 hover:bg-danger-50 hover:text-danger-700"
                                        title="Hapus penilaian">
                                        <x-heroicon-m-trash class="h-4 w-4" />
                                    </button>
                                </div>
                            </th>

                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($students as $student)

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="whitespace-nowrap px-4 py-3 text-gray-600 dark:text-gray-400">{{ $student->nisn }}</td>

                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-950 dark:text-white">
                                {{ $student->name }}
                            </td>

                            @foreach ($assessmentNames as $assessmentName) @php $score = \App\Models\JournalAssessment::query()
                                    ->where('teaching_journal_id', $journalId)->where('student_id', $student->id)->where(
                                        'name',
                                        $assessmentName
                                )->value('score'); @endphp

                                <td class="px-4 py-3 text-center">
                                    <input type="number" min="0" max="100" step="0.01" value="{{ $score }}" wire:change="updateScore(
                                                                    {{ $student->id }},
                                                                    @js($assessmentName),
                                                                    $event.target.value
                                                                )"
                                        class="w-24 rounded-lg border-gray-300 text-center text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800" />
                                </td>

                            @endforeach
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

    @endif {{-- MODAL KONFIRMASI HAPUS --}} @if ($deleteName)

        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl dark:bg-gray-900">
                <h3 class="text-lg font-semibold text-gray-950 dark:text-white">Hapus Penilaian?</h3>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Penilaian
                    <strong class="text-gray-900 dark:text-white"> "{{ $deleteName }}" </strong>

                    dan seluruh nilai siswa pada penilaian ini akan dihapus.
                </p>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" wire:click="cancelDelete"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
                        Batal
                    </button>

                    <button type="button" wire:click="deleteAssessment"
                        class="rounded-lg bg-danger-600 px-4 py-2 text-sm font-semibold text-white hover:bg-danger-500">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>

    @endif
</div>