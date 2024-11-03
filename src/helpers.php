<?php

use Carbon\Carbon;
use EncoreDigitalGroup\Tachyon\Tachyon;

if (!function_exists('unix_seconds_until')) {
    /** @deprecated Use Tachyon::unixDiffInSeconds instead */
    function unix_seconds_until(Carbon|DateTime $targetDateTime, string $targetTimezone = 'UTC'): float|int
    {
        return Tachyon::make('UTC', $targetTimezone)->unixDiffInSeconds($targetDateTime);
    }
}
