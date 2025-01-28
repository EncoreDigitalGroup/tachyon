<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use EncoreDigitalGroup\Tachyon\Exceptions\TachyonException;

/** @internal */
trait TimeDiff
{
    /** @throws TachyonException */
    public function unixDiffInSeconds(DateTime $targetDateTime): float|int
    {
        $targetDateTimeString = $targetDateTime->format("Y-m-d H:i:s");

        $sourceDateTime = CarbonImmutable::now()->setTimezone($this->targetTimezone)->toDateTimeString();

        if ($sourceDateTime === '' || $sourceDateTime === '0') {
            throw new TachyonException;
        }

        $targetDateTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $targetDateTimeString, $this->targetTimezone);

        if (!$targetDateTime instanceof CarbonImmutable) {
            throw new TachyonException("Invalid targetDateTime Provided.");
        }

        return (int) round($targetDateTime->diffInSeconds($sourceDateTime, true));
    }
}
