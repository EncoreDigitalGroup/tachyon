<?php

namespace EncoreDigitalGroup\Tachyon;

use EncoreDigitalGroup\Tachyon\Traits\GenericHelpers;
use EncoreDigitalGroup\Tachyon\Traits\KeyTimeIndicators;
use EncoreDigitalGroup\Tachyon\Traits\TimeDiff;
use Illuminate\Support\Carbon;

class Tachyon extends Carbon
{
    use GenericHelpers;
    use KeyTimeIndicators;
    use TimeDiff;
}