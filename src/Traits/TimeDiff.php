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

        $sourceDateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), $this->targetTimezone);

        if (! $sourceDateTime) {
            throw new TachyonException;
        }

        $sourceDateTime->toDateTimeString();

        $targetDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $targetDateTimeString, $this->targetTimezone);

        if (! $targetDateTime) {
            throw new TachyonException('Invalid targetDateTime Provided.');
        }

        return $targetDateTime->diffInSeconds($sourceDateTime);
    }
}
