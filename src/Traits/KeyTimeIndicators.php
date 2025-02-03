<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\CarbonInterface;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidEndTimeProvidedException;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidStartTimeProvidedException;
use EncoreDigitalGroup\Tachyon\Support\TimestampFormat;
use Illuminate\Support\Carbon;

/**
 * @internal
 */
trait KeyTimeIndicators
{
    use GenericHelpers;

    public function startingSoon(): bool
    {
        $startDateTime = static::createFromFormat(TimestampFormat::STANDARD, $this->toDateTimeString());

        if (!$startDateTime instanceof CarbonInterface) {
            throw new InvalidStartTimeProvidedException;
        }

        $oneHourFromStartTime = static::createFromFormat(TimestampFormat::STANDARD, $this->toDateTimeString())?->subHours();
        $now = static::now()->setTimezone($this->targetTimezone);
        $isToday = static::createFromFormat(TimestampFormat::STANDARD, $this->toDateTimeString())
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

        $startDateTime = static::createFromFormat(TimestampFormat::STANDARD, $startTime, $this->targetTimezone);
        $endDateTime = static::createFromFormat(TimestampFormat::STANDARD, $endTime, $this->targetTimezone);

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
        $startDateTime = static::createFromFormat(TimestampFormat::STANDARD, $this->toDateTimeString());

        if (!$startDateTime instanceof static) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);

        $threeHoursBefore = static::createFromFormat(TimestampFormat::STANDARD, $this->toDateTimeString())
            ?->setTimezone($this->targetTimezone)
            ->subHours(3);

        // @phpstan-ignore-line
        return $now > $threeHoursBefore && $now < $startDateTime;
    }

    public function isToday(): bool
    {
        $startDateTime = Carbon::createFromFormat(TimestampFormat::STANDARD, $this->toDateTimeString());

        if (!$startDateTime instanceof CarbonInterface) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);

        $isToday = $startDateTime->isToday();
        $now = static::now()->setTimezone($this->targetTimezone);

        return $isToday && $now < $startDateTime;
    }
}
