<?php

use Carbon\Carbon;
use EncoreDigitalGroup\Tachyon\Tachyon;

if(!function_exists('unix_seconds_until')) {
    function unix_seconds_until(Carbon|DateTime $targetDateTime, $targetTimezone = 'UTC'): float|int
    {
        return (new Tachyon('UTC', $targetTimezone))->unixDiffInSeconds($targetDateTime);
    }
}