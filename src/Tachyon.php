<?php

namespace EncoreDigitalGroup\Tachyon;

use Carbon\Carbon;

class Tachyon
{
    protected string $source_timezone;
    protected string $target_timezone;

    public function __construct($source_timezone = 'UTC', $target_timezone = 'UTC')
    {
        $this->source_timezone = $source_timezone;
        $this->target_timezone = $target_timezone;
    }

    public function set_source($source_timezone = 'UTC'): void
    {
        $this->source_timezone = $source_timezone;
    }

    public function set_target($target_timezone = 'UTC'): void
    {
        $this->target_timezone = $target_timezone;
    }

    public function startingSoon($start_time = null): bool
    {
        if($start_time == null) {
            return false;
        }

        $TargetTimezone = $this->target_timezone;
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone);
        $OneHourFromStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone)->subHours(1);
        $Now = Carbon::now()->setTimezone($TargetTimezone);
        $IsToday = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone)->isToday();
        if (($Now < $StartTime) && ($Now > $OneHourFromStartTime) && ($IsToday)) {
            return true;
        }

        return false;
    }

    public function happeningNow($start_time = null, $end_time = null): bool
    {
        if($start_time == null || $end_time == null) {
            return false;
        }

        $TargetTimezone = $this->target_timezone;
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone);
        $EndTime = Carbon::createFromFormat('Y-m-d H:i:s', $end_time)->setTimezone($TargetTimezone);
        $IsToday = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone)->isToday();
        if ($StartTime < Carbon::now()->setTimezone($TargetTimezone) && $EndTime > Carbon::now()->setTimezone($TargetTimezone) && $IsToday) {
            return true;
        }

        return false;
    }

    public function withinThreeHours($start_time = null): bool
    {
        if($start_time == null) {
            return false;
        }

        $TargetTimezone = $this->target_timezone;
        $Now = Carbon::now()->setTimezone($TargetTimezone);
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time);
        $ThreeHoursBefore = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone)->subHours(3);
        if ($Now > $ThreeHoursBefore && $Now < $StartTime) {
            return true;
        }

        return false;
    }

    public function isToday($start_time = null): bool
    {
        if($start_time == null) {
            return false;
        }

        $TargetTimezone = $this->target_timezone;
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone);
        $IsToday = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($TargetTimezone)->isToday();
        $Now = Carbon::now()->setTimezone($TargetTimezone);
        if ($IsToday && $Now < $StartTime) {
            return true;
        }

        return false;
    }
}