<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use DateTime;
use EncoreDigitalGroup\Tachyon\Exceptions\TachyonException;

/** @internal */
trait TimeDiff
{
    /** @throws TachyonException */
    public function unixDiffInSeconds(DateTime $targetDateTime): float|int
    {
        $targetDateTimeString = $targetDateTime->format("Y-m-d H:i:s");

        $sourceDateTime = Carbon::now()->setTimezone($this->targetTimezone)->toDateTimeString();

        if ($sourceDateTime === '' || $sourceDateTime === '0') {
            throw new TachyonException;
        }

        $targetDateTime = Carbon::createFromFormat("Y-m-d H:i:s", $targetDateTimeString, $this->targetTimezone);

        if (!$targetDateTime instanceof \Carbon\Carbon) {
            throw new TachyonException("Invalid targetDateTime Provided.");
        }

        return (int) round($targetDateTime->diffInSeconds($sourceDateTime, true));
    }
}
