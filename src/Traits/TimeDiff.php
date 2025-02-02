<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use DateTime;
use EncoreDigitalGroup\Tachyon\Exceptions\TachyonException;
use EncoreDigitalGroup\Tachyon\Support\TimestampFormat;

/**
 * @internal
 */
trait TimeDiff
{
    /** @throws TachyonException */
    public function unixDiffInSeconds(DateTime $targetDateTime): float|int
    {
        $targetDateTimeString = $targetDateTime->format(TimestampFormat::STANDARD);

        $sourceDateTime = static::now()->setTimezone($this->targetTimezone)->toDateTimeString();

        if ($sourceDateTime === '' || $sourceDateTime === '0') {
            throw new TachyonException;
        }

        $targetDateTime = static::createFromFormat(TimestampFormat::STANDARD, $targetDateTimeString, $this->targetTimezone);

        if (!$targetDateTime instanceof static) {
            throw new TachyonException("Invalid targetDateTime Provided.");
        }

        return (int) round($targetDateTime->diffInSeconds($sourceDateTime, true));
    }
}
