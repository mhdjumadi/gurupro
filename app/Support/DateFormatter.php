<?php

namespace App\Support;

use Carbon\Carbon;

class DateFormatter
{
    public static function indonesia($date, string $format = 'l, d F Y'): string
    {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)
            ->locale('id')
            ->translatedFormat($format);
    }
}