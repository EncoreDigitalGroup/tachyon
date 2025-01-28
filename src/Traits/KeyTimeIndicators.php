<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidEndTimeProvidedException;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidStartTimeProvidedException;

/** @internal */
trait KeyTimeIndicators
{
    use GenericHelpers;

    public function startingSoon(): bool
    {
        $startDateTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString());

        if (!$startDateTime instanceof CarbonImmutable) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);
        $oneHourFromStartTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString())?->subHours();
        $now = CarbonImmutable::now()->setTimezone($this->targetTimezone);
        $isToday = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString())
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

        $startDateTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $startTime, $this->targetTimezone);
        $endDateTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $endTime, $this->targetTimezone);

        if (!$startDateTime instanceof CarbonImmutable) {
            throw new InvalidStartTimeProvidedException;
        }

        if (!$endDateTime instanceof CarbonImmutable) {
            throw new InvalidEndTimeProvidedException;
        }

        return $startDateTime < CarbonImmutable::now($this->targetTimezone) && $endDateTime > CarbonImmutable::now($this->targetTimezone);
    }

    public function withinThreeHours(): bool
    {
        $now = CarbonImmutable::now()->setTimezone($this->targetTimezone);
        $startDateTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString());

        if (!$startDateTime instanceof CarbonImmutable) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);

        $threeHoursBefore = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString())
            ?->setTimezone($this->targetTimezone)
            ->subHours(3);

        // @phpstan-ignore-line
        return $now > $threeHoursBefore && $now < $startDateTime;
    }

    public function isToday(): bool
    {
        $startDateTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $this->toDateTimeString());

        if (!$startDateTime instanceof CarbonImmutable) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($this->targetTimezone);

        $isToday = $startDateTime->isToday();
        $now = CarbonImmutable::now()->setTimezone($this->targetTimezone);

        return $isToday && $now < $startDateTime;
    }
}
