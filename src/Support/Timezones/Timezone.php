<?php

namespace EncoreDigitalGroup\Tachyon\Support\Timezones;

use DateTimeZone;
use Illuminate\Support\Collection;

class Timezone
{
    public const string UTC = "UTC";

    public static function list(TimezoneGroup $timezoneGroup = TimezoneGroup::All): Collection
    {
        $identifiers = DateTimeZone::listIdentifiers($timezoneGroup->value);

        return new Collection($identifiers);
    }
}