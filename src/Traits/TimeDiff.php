<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use DateTime;

trait TimeDiff
{
    public function unixDiffInSeconds(Carbon|DateTime $targetDateTime): float|int
    {
        $sourceDateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), $this->targetTimezone);
        $targetDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $targetDateTime, $this->targetTimezone);

        return $targetDateTime->diffInSeconds($sourceDateTime);
    }
}