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
        $oneHourFromStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime)->subHours(1); // @phpstan-ignore-line
        $now = Carbon::now()->setTimezone($targetTimezone);
        $isToday = Carbon::createFromFormat('Y-m-d H:i:s', $startTime)->setTimezone($targetTimezone)->isToday(); // @phpstan-ignore-line

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
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime, $targetTimezone);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endTime, $targetTimezone);

        if (! $startDateTime) {
            throw new InvalidStartTimeProvidedException;
        }

        if (! $endDateTime) {
            throw new InvalidEndTimeProvidedException;
        }

        if ($startDateTime < Carbon::now($targetTimezone) && $endDateTime > Carbon::now($targetTimezone)) {
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

        $startDateTime = $startDateTime->setTimezone($targetTimezone);

        $threeHoursBefore = Carbon::createFromFormat('Y-m-d H:i:s', $startTime)->setTimezone($targetTimezone)->subHours(3); // @phpstan-ignore-line

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
