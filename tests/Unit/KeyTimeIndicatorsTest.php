<?php

use Carbon\Carbon;
use EncoreDigitalGroup\Tachyon\Tachyon;

test('Starting Soon is True', function () {
    $startTime = Carbon::now()->addMinutes(15)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->startingSoon($startTime))->toBeTrue();
});

test('Starting Soon is False', function () {
    $startTime = Carbon::now()->addHours(2)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->startingSoon($startTime))->toBeFalse();
});

test('Happening Now is True', function () {
    $startTime = Carbon::now()->subHours(2)->toDateTimeString();
    $endTime = Carbon::now()->addHours(3)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->happeningNow($startTime, $endTime))->toBeTrue();
});

test('Happening Now is False', function () {
    $startTime = Carbon::now()->subHours(6)->toDateTimeString();
    $endTime = Carbon::now()->subHours(5)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->happeningNow($startTime, $endTime))->toBeFalse();
});

test('Within Three Hours is True', function () {
    $startTime = Carbon::now()->addHours(2)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->withinThreeHours($startTime))->toBeTrue();
});

test('Within Three Hours is False', function () {
    $startTime = Carbon::now()->addHours(4)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->withinThreeHours($startTime))->toBeFalse();
});

test('Is Today is True', function () {
    $startTime = Carbon::now()->addHours(4)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->isToday($startTime))->toBeTrue();
});

test('Is Today is False', function () {
    $startTime = Carbon::now()->addDays(4)->toDateTimeString();
    $tachyon = new Tachyon;

    expect($tachyon->isToday($startTime))->toBeFalse();
});
