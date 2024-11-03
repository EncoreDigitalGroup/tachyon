<?php

namespace EncoreDigitalGroup\Tachyon;

use EncoreDigitalGroup\Tachyon\Traits\GenericHelpers;
use EncoreDigitalGroup\Tachyon\Traits\KeyTimeIndicators;
use EncoreDigitalGroup\Tachyon\Traits\TimeDiff;

class Tachyon
{
    use GenericHelpers;
    use KeyTimeIndicators;
    use TimeDiff;

    protected static self $instance;

    protected string $sourceTimezone;
    protected string $targetTimezone;

    /** @experimental */
    public static function make(?string $targetTimezone = null, ?string $sourceTimezone = null): self
    {
        $defaultTimezone = 'UTC';

        if (!isset(static::$instance) && is_null($targetTimezone) && is_null($sourceTimezone)) {
            static::$instance = new self($defaultTimezone, $defaultTimezone);
            return static::$instance;
        } elseif (isset(static::$instance) && is_null($targetTimezone) && is_null($sourceTimezone)) {
            return static::$instance;
        } elseif (isset(static::$instance) && (!is_null($targetTimezone) || !is_null($sourceTimezone))) {
            static::$instance = new self($targetTimezone ?? $defaultTimezone, $sourceTimezone ?? $defaultTimezone);
        }

        return static::$instance;
    }

    public function __construct(string $targetTimezone = 'UTC', string $sourceTimezone = 'UTC')
    {
        $this->sourceTimezone = $sourceTimezone;
        $this->targetTimezone = $targetTimezone;
    }

    public function setSource(string $sourceTimezone = 'UTC'): void
    {
        $this->sourceTimezone = $sourceTimezone;
    }

    public function getSource(): string
    {
        return $this->sourceTimezone;
    }

    public function setTarget(string $targetTimezone = 'UTC'): void
    {
        $this->targetTimezone = $targetTimezone;
    }

    public function getTarget(): string
    {
        return $this->targetTimezone;
    }
}
