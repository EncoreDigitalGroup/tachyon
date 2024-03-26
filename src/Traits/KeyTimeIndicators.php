<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidEndTimeProvidedException;
use EncoreDigitalGroup\Tachyon\Exceptions\InvalidStartTimeProvidedException;

trait KeyTimeIndicators
{
    /**
     * @throws InvalidStartTimeProvidedException
     */
    public function startingSoon(?string $startTime = null): bool
    {
        if ($startTime == null) {
            return false;
        }

        $targetTimezone = $this->targetTimezone;

        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime);

        if (! $startDateTime) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($targetTimezone);
        $oneHourFromStartTime = $startDateTime->subHours(1);
        $now = Carbon::now()->setTimezone($targetTimezone);
        $isToday = $startDateTime->isToday();

        if (($now < $startDateTime) && ($now > $oneHourFromStartTime) && ($isToday)) {
            return true;
        }

        return false;
    }

    /**
     * @throws InvalidStartTimeProvidedException
     * @throws InvalidEndTimeProvidedException
     */
    public function happeningNow(?string $startTime = null, ?string $endTime = null): bool
    {
        if ($startTime == null || $endTime == null) {
            return false;
        }

        $targetTimezone = $this->targetTimezone;
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endTime);

        if (! $startDateTime) {
            throw new InvalidStartTimeProvidedException;
        }

        if (! $endDateTime) {
            throw new InvalidEndTimeProvidedException;
        }

        $startDateTime->setTimezone($targetTimezone);
        $endDateTime->setTimezone($targetTimezone);
        $isToday = $startDateTime->isToday();

        if ($startDateTime < Carbon::now()->setTimezone($targetTimezone) && $endDateTime > Carbon::now()->setTimezone($targetTimezone) && $isToday) {
            return true;
        }

        return false;
    }

    /**
     * @throws InvalidStartTimeProvidedException
     */
    public function withinThreeHours(?string $startTime = null): bool
    {
        if ($startTime == null) {
            return false;
        }

        $targetTimezone = $this->targetTimezone;
        $now = Carbon::now()->setTimezone($targetTimezone);
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime);

        if (! $startDateTime) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime->setTimezone($targetTimezone);

        $threeHoursBefore = $startDateTime->subHours(3);

        if ($now > $threeHoursBefore && $now < $startDateTime) {
            return true;
        }

        return false;
    }

    /**
     * @throws InvalidStartTimeProvidedException
     */
    public function isToday(?string $startTime = null): bool
    {
        if ($startTime == null) {
            return false;
        }

        $targetTimezone = $this->targetTimezone;
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime);

        if (! $startDateTime) {
            throw new InvalidStartTimeProvidedException;
        }

        $startDateTime = $startDateTime->setTimezone($targetTimezone);

        $isToday = $startDateTime->isToday();
        $now = Carbon::now()->setTimezone($targetTimezone);

        if ($isToday && $now < $startDateTime) {
            return true;
        }

        return false;
    }
}
