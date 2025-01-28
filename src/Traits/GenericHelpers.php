<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use Carbon\Exceptions\InvalidFormatException;
use DateTimeZone;

/** @internal */
trait GenericHelpers
{
    protected DateTimeZone|string $targetTimezone = "UTC";

    public static function fromArrayIndex(array $array, int|string $index, string $format): ?static
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
        return static::fromArrayIndex($array, $index, "m/d/y");
    }

    public function setTargetTimezone(string $targetTimezone): static
    {
        $this->setTimezone($targetTimezone);

        return $this;
    }
}
