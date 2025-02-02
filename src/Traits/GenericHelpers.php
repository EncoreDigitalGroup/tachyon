<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Exceptions\InvalidFormatException;
use DateTimeZone;

/**
 * @internal
 */
trait GenericHelpers
{
    private const string FORMAT_MDY = "m/d/y";
    private const string TIMEZONE_UTC = "UTC";

    protected DateTimeZone|string $targetTimezone = self::TIMEZONE_UTC;

    public static function fromArrayIndex(array $array = [], int|string $index = 0, string $format = self::FORMAT_MDY): ?static
    {
        try {
            $date = static::createFromFormat($format, $array[$index]);
        } catch (InvalidFormatException) {
            $date = null;
        }

        return $date;
    }

    public static function mdyFromArrayIndex(array $array = [], int|string $index = 0): ?static
    {
        return static::fromArrayIndex($array, $index);
    }

    public function setTargetTimezone(string $targetTimezone = self::TIMEZONE_UTC): static
    {
        $this->setTimezone($targetTimezone);

        return $this;
    }
}
