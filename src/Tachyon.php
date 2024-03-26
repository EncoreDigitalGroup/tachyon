<?php

namespace EncoreDigitalGroup\Tachyon;

use EncoreDigitalGroup\Tachyon\Traits\KeyTimeIndicators;
use EncoreDigitalGroup\Tachyon\Traits\TimeDiff;

class Tachyon
{
    use KeyTimeIndicators;
    use TimeDiff;

    protected string $sourceTimezone;
    protected string $targetTimezone;

    public function __construct(string $targetTimezone = 'UTC', string $sourceTimezone = 'UTC')
    {
        $this->sourceTimezone = $sourceTimezone;
        $this->targetTimezone = $targetTimezone;
    }

    public function setSource(string $sourceTimezone = 'UTC'): void
    {
        $this->sourceTimezone = $sourceTimezone;
    }

    public function setTarget(string $targetTimezone = 'UTC'): void
    {
        $this->targetTimezone = $targetTimezone;
    }
}