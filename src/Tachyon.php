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

    public function __construct($source_timezone = 'UTC', $target_timezone = 'UTC')
    {
        $this->sourceTimezone = $source_timezone;
        $this->targetTimezone = $target_timezone;
    }

    /**
     * @param string $source_timezone
     * @deprecated use setSource instead
     */
    public function set_source(string $source_timezone = 'UTC'): void
    {
        $this->setSource($source_timezone);
    }

    public function setSource(string $sourceTimezone = 'UTC'): void
    {
        $this->sourceTimezone = $sourceTimezone;
    }

    /**
     * @param string $target_timezone
     * @deprecated use setTarget instead
     */
    public function set_target(string $target_timezone = 'UTC'): void
    {
        $this->setTarget($target_timezone);
    }

    public function setTarget(string $targetTimezone = 'UTC'): void
    {
        $this->targetTimezone = $targetTimezone;
    }


}