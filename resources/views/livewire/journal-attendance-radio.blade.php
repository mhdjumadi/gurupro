@php
    $record = $getState()['record'];
    $status = $getState()['status'];

    $colors = [
        'hadir' => 'accent-green-600',
        'sakit' => 'accent-yellow-500',
        'izin' => 'accent-blue-600',
        'alpa' => 'accent-red-600',
    ];
@endphp

<div class="flex justify-center">
    <input type="radio" name="attendance_{{ $record->id }}" value="{{ $status }}"
        wire:click="updateStatus('{{ $record->id }}', '{{ $status }}')" @checked($record->status === $status)
        class="h-5 w-5 cursor-pointer {{ $colors[$status] }}" title="{{ ucfirst($status) }}">
</div>