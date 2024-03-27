<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use DateTime;
use EncoreDigitalGroup\Tachyon\Exceptions\TachyonException;

trait TimeDiff
{
    /**
     * @throws TachyonException
     */
    public function unixDiffInSeconds(Carbon|DateTime $targetDateTime): float|int
    {
        $targetDateTimeString = $targetDateTime->format('Y-m-d H:i:s');

        $sourceDateTime = Carbon::now()->setTimezone($this->targetTimezone)->toDateTimeString();

        if (!$sourceDateTime) {
            throw new TachyonException;
        }

        $targetDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $targetDateTimeString, $this->targetTimezone);

        if (! $targetDateTime) {
            throw new TachyonException('Invalid targetDateTime Provided.');
        }

        return (int)round($targetDateTime->diffInSeconds($sourceDateTime, true));
    }
}
