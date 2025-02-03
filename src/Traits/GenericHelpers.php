<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Exceptions\InvalidFormatException;
use DateTimeZone;
use EncoreDigitalGroup\Tachyon\Support\TimestampFormat;
use EncoreDigitalGroup\Tachyon\Support\Timezones\Timezone;

/** @internal */
trait GenericHelpers
{
    protected DateTimeZone|string $targetTimezone = Timezone::UTC;

    public static function fromArrayIndex(array $array, int|string $index, string $format = TimestampFormat::MDY): ?static
    {
        try {
            $date = static::createFromFormat($format, $array[$index]);
        } catch (InvalidFormatException) {
            $date = null;
        }

        return $date;
    }

    public static function mdyFromArrayIndex(array $array, int|string $index): ?static
    {
        return static::fromArrayIndex($array, $index);
    }

    public function setTargetTimezone(string $timezone = Timezone::UTC): static
    {
        $this->setTimezone($timezone);

        return $this;
    }
}
