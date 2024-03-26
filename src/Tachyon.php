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

    /**
     * @param string $sourceTimezone
     * @deprecated use setSource instead
     */
    public function set_source(string $sourceTimezone = 'UTC'): void
    {
        $this->setSource($sourceTimezone);
    }

    public function setSource(string $sourceTimezone = 'UTC'): void
    {
        $this->sourceTimezone = $sourceTimezone;
    }

    /**
     * @param string $targetTimezone
     * @deprecated use setTarget instead
     */
    public function set_target(string $targetTimezone = 'UTC'): void
    {
        $this->setTarget($targetTimezone);
    }

    public function setTarget(string $targetTimezone = 'UTC'): void
    {
        $this->targetTimezone = $targetTimezone;
    }


}