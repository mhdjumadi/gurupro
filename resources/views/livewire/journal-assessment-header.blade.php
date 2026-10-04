<div class="flex items-center justify-center gap-1 whitespace-nowrap">
    <span class="font-semibold">
        {{ $name }}
    </span>

    <button type="button" wire:click="deleteAssessment('{{ $name }}')"
        wire:confirm="Hapus penilaian {{ $name }}? Semua nilai siswa pada penilaian ini akan ikut dihapus."
        class="text-danger-600 hover:text-danger-500" title="Hapus penilaian">
        <x-heroicon-micro-trash class="h-4 w-4" />
    </button>
</div>