<?php

namespace EncoreDigitalGroup\Tachyon\Traits;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

/** @internal */
trait GenericHelpers
{
    public static function fromArrayIndex(array $array, int|string $index, string $format): ?Carbon
    {
        try {
            $date = Carbon::createFromFormat($format, $array[$index]);
        } catch (InvalidFormatException) {
            $date = null;
        }

        return $date;
    }

    public static function mdyFromArrayIndex(array $array, int|string $index): ?Carbon
    {
        return static::fromArrayIndex($array, $index, "m/d/y");
    }
}
