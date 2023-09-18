<?php

namespace EncoreDigitalGroup\Tachyon;

use Carbon\Carbon;

class DateHelper
{
    public function happeningSoon($start_time, $timezone = 'UTC')
    {
        $Timezone = $timezone;
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($Timezone);
        $OneHourFromStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($Timezone)->subHours(1);
        $Now = Carbon::now()->setTimezone($Timezone);
        $IsToday = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($Timezone)->isToday();
        if ($StartTime >= $OneHourFromStartTime && $Now < $StartTime && $IsToday) {
            return true;
        }

        return false;
    }

    public function happeningNow($start_time, $end_time, $timezone = 'UTC')
    {
        $Timezone = $timezone;
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($Timezone);
        $EndTime = Carbon::createFromFormat('Y-m-d H:i:s', $end_time)->setTimezone($Timezone);
        $IsToday = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($Timezone)->isToday();
        if ($StartTime < Carbon::now()->setTimezone($Timezone) && $EndTime > Carbon::now()->setTimezone($Timezone) && $IsToday) {
            return true;
        }

        return false;
    }

    public function withinThreeHours($start_time, $timezone = 'UTC')
    {
        $Timezone = $timezone;
        $Now = Carbon::now()->setTimezone($Timezone);
        $StartTime = Carbon::createFromFormat('Y-m-d H:i:s', $start_time);
        $ThreeHoursBefore = Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->setTimezone($Timezone)->subHours(3);
        if ($Now > $ThreeHoursBefore && $Now < $StartTime) {
            return true;
        }

        return false;
    }
}