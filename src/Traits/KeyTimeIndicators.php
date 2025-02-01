<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\CarbonInterface;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidEndTimeProvidedException;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidStartTimeProvidedException;

/**
 * @internal
 * @mixin CarbonInterface
 */
trait KeyTimeIndicators
{
    use GenericHelpers;

    public function startingSoon(): bool
    {
        $startDateTime = static::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString());

        if (!$startDateTime instanceof static) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);
        $oneHourFromStartTime = static::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString())?->subHours();
        $now = static::now()->setTimezone($this->targetTimezone);
        $isToday = static::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString())
            ?->setTimezone($this->targetTimezone)
            ->isToday();

        // @phpstan-ignore-line
        return ($now < $startDateTime) && ($now > $oneHourFromStartTime) && ($isToday);
    }

    public function happeningNow(?string $startTime = null, ?string $endTime = null): bool
    {
        if ($startTime == null || $endTime == null) {
            return false;
        }

        $startDateTime = static::createFromFormat("Y-m-d H:i:s", $startTime, $this->targetTimezone);
        $endDateTime = static::createFromFormat("Y-m-d H:i:s", $endTime, $this->targetTimezone);

        if (!$startDateTime instanceof static) {
            throw new InvalidStartTimeProvidedException;
        }

        if (!$endDateTime instanceof static) {
            throw new InvalidEndTimeProvidedException;
        }

        return $startDateTime < static::now($this->targetTimezone) && $endDateTime > static::now($this->targetTimezone);
    }

    public function withinThreeHours(): bool
    {
        $now = static::now()->setTimezone($this->targetTimezone);
        $startDateTime = static::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString());

        if (!$startDateTime instanceof static) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);

        $threeHoursBefore = static::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString())
            ?->setTimezone($this->targetTimezone)
            ->subHours(3);

        // @phpstan-ignore-line
        return $now > $threeHoursBefore && $now < $startDateTime;
    }

    public function isToday(): bool
    {
        $startDateTime = static::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString());

        if (!$startDateTime instanceof static) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);

        $isToday = $startDateTime->isToday();
        $now = static::now()->setTimezone($this->targetTimezone);

        return $isToday && $now < $startDateTime;
    }
}
