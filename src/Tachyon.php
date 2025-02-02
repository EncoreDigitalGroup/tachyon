<?php

namespace EncoreDigitalGroup\Tachyon;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use EncoreDigitalGroup\Tachyon\Traits\GenericHelpers;
use EncoreDigitalGroup\Tachyon\Traits\KeyTimeIndicators;
use EncoreDigitalGroup\Tachyon\Traits\TimeDiff;

class Tachyon
{
    use GenericHelpers;
    use KeyTimeIndicators;
    use TimeDiff;

    public static function loadMixin(): void
    {
        Carbon::mixin(new self);
        CarbonImmutable::mixin(new self);
    }
}