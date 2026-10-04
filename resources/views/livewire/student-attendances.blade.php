<div class="mb-4 grid grid-cols-2 gap-3 md:grid-cols-4">

    {{-- Hadir --}}
    <div class="rounded-xl border border-success-200 bg-success-50 p-4 dark:border-success-800 dark:bg-success-950">
        <div class="text-sm font-medium text-success-600 dark:text-success-400">
            Hadir
        </div>

        <div class="mt-1 text-2xl font-bold text-success-700 dark:text-success-300">
            {{ $this->getViewData()['hadir'] }}
        </div>
    </div>

    {{-- Sakit --}}
    <div class="rounded-xl border border-warning-200 bg-warning-50 p-4 dark:border-warning-800 dark:bg-warning-950">
        <div class="text-sm font-medium text-warning-600 dark:text-warning-400">
            Sakit
        </div>

        <div class="mt-1 text-2xl font-bold text-warning-700 dark:text-warning-300">
            {{ $this->getViewData()['sakit'] }}
        </div>
    </div>

    {{-- Izin --}}
    <div class="rounded-xl border border-info-200 bg-info-50 p-4 dark:border-info-800 dark:bg-info-950">
        <div class="text-sm font-medium text-info-600 dark:text-info-400">
            Izin
        </div>

        <div class="mt-1 text-2xl font-bold text-info-700 dark:text-info-300">
            {{ $this->getViewData()['izin'] }}
        </div>
    </div>

    {{-- Alpa --}}
    <div class="rounded-xl border border-danger-200 bg-danger-50 p-4 dark:border-danger-800 dark:bg-danger-950">
        <div class="text-sm font-medium text-danger-600 dark:text-danger-400">
            Alpa
        </div>

        <div class="mt-1 text-2xl font-bold text-danger-700 dark:text-danger-300">
            {{ $this->getViewData()['alpa'] }}
        </div>
    </div>

</div>