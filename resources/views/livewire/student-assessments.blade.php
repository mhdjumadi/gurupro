<div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

    <div class="px-6 py-4">
        <h3 class="text-base font-semibold text-gray-950 dark:text-white">
            📊 Rekap Nilai
        </h3>
    </div>

    @php
        $assessmentNames = $this->getAssessmentNames();
        $subjects = $this->getSubjects();
    @endphp

    @if ($subjects->isEmpty())

        <div class="px-6 pb-6">
            <div class="rounded-lg bg-gray-50 p-6 text-center text-sm text-gray-500 dark:bg-gray-800">
                Belum ada data penilaian.
            </div>
        </div>

    @else

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="border-t border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800">

                        <th class="px-6 py-3 text-left font-semibold">
                            Mata Pelajaran
                        </th>

                        @foreach ($assessmentNames as $name)
                            <th class="px-4 py-3 text-center font-semibold">
                                {{ $name }}
                            </th>
                        @endforeach

                        <th class="px-4 py-3 text-center font-semibold">
                            Rata-rata
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($subjects as $subject)

                        <tr class="border-t border-gray-200 dark:border-gray-700">

                            <td class="px-6 py-4 font-semibold">
                                {{ $subject['name'] }}
                            </td>

                            @foreach ($assessmentNames as $name)

                                @php
                                    $score = $subject['scores'][$name] ?? null;
                                @endphp

                                <td class="px-4 py-4 text-center">

                                    @if ($score !== null)

                                            <span class="
                                                                    inline-flex
                                                                    min-w-10
                                                                    justify-center
                                                                    rounded-full
                                                                    px-2.5
                                                                    py-1
                                                                    text-xs
                                                                    font-semibold

                                                                    {{ $score >= 90
                                        ? 'bg-green-100 text-green-700'
                                        : ($score >= 75
                                            ? 'bg-blue-100 text-blue-700'
                                            : ($score >= 60
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : 'bg-red-100 text-red-700')) }}
                                                                ">
                                                {{ $score }}
                                            </span>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>

                            @endforeach

                            <td class="px-4 py-4 text-center">

                                @if ($subject['average'] !== null)

                                    <span class="font-bold">
                                        {{ number_format($subject['average'], 2) }}
                                    </span>

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    @endif

</div>