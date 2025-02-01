<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use EncoreDigitalGroup\Tachyon\Tachyon;

Carbon::mixin(new Tachyon);
CarbonImmutable::mixin(new Tachyon);