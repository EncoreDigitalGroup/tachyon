<?php

namespace EncoreDigitalGroup\Tachyon;

/**
 * @deprecated Use the Tachyon class instead.
 */
class DateHelper
{
    protected string $source_timezone;
    protected string $target_timezone;
    protected Tachyon $tachyon;

    public function __construct($target_timezone = 'UTC', $source_timezone = 'UTC')
    {
        $this->tachyon = new Tachyon($source_timezone, $target_timezone);
    }

    public function happeningSoon($start_time = null): bool
    {
        return $this->tachyon->startingSoon($start_time);
    }

    public function happeningNow($start_time = null, $end_time = null): bool
    {
        return $this->tachyon->happeningNow($start_time, $end_time);
    }

    public function withinThreeHours($start_time = null): bool
    {
        return $this->tachyon->withinThreeHours($start_time);
    }

    public function isToday($start_time = null): bool
    {
        return $this->tachyon->isToday($start_time);
    }
}
