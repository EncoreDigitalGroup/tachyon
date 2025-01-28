<?php

namespace EncoreDigitalGroup\Tachyon;

use Carbon\CarbonImmutable;
use EncoreDigitalGroup\Tachyon\Traits\GenericHelpers;
use EncoreDigitalGroup\Tachyon\Traits\KeyTimeIndicators;
use EncoreDigitalGroup\Tachyon\Traits\TimeDiff;

class Tachyon extends CarbonImmutable
{
    use GenericHelpers;
    use KeyTimeIndicators;
    use TimeDiff;
}