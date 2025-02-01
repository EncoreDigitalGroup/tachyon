<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\CarbonInterface;
use DateTime;
use EncoreDigitalGroup\Tachyon\Exceptions\TachyonException;

/**
 * @internal
 * @mixin CarbonInterface
 */
trait TimeDiff
{
    private const string FORMAT = "Y-m-d- H:i:s";

    /** @throws TachyonException */
    public function unixDiffInSeconds(?DateTime $targetDateTime = null): float|int
    {
        if(is_null($targetDateTime)) {
            $targetDateTime = static::now()->format(self::FORMAT);
        }

        $targetDateTimeString = $targetDateTime->format(self::FORMAT);

        $sourceDateTime = static::now()->setTimezone($this->targetTimezone)->toDateTimeString();

        if ($sourceDateTime === '' || $sourceDateTime === '0') {
            throw new TachyonException;
        }

        $targetDateTime = static::createFromFormat(self::FORMAT, $targetDateTimeString, $this->targetTimezone);

        if (!$targetDateTime instanceof static) {
            throw new TachyonException("Invalid targetDateTime Provided.");
        }

        return (int) round($targetDateTime->diffInSeconds($sourceDateTime, true));
    }
}
