<?php

use EncoreDigitalGroup\Tachyon\Tachyon;

test("Starting Soon is True", function (): void {
    $tachyon = Tachyon::now()->addMinutes(15);

    expect($tachyon->startingSoon())->toBeTrue();
});

test("Starting Soon is False", function (): void {
    $tachyon = Tachyon::now()->addHours(2);

    expect($tachyon->startingSoon())->toBeFalse();
});

test("Happening Now is True", function (): void {
    $startTime = Tachyon::now()->subHours(6)->toDateTimeString();
    $endTime = Tachyon::now()->addHours(5)->toDateTimeString();

    expect(Tachyon::now()->happeningNow($startTime, $endTime))->toBeTrue();
});

test("Happening Now is False", function (): void {
    $startTime = Tachyon::now()->subHours(6)->toDateTimeString();
    $endTime = Tachyon::now()->subHours(5)->toDateTimeString();

    expect(Tachyon::now()->happeningNow($startTime, $endTime))->toBeFalse();
});

test("Within Three Hours is True", function (): void {
    $tachyon = Tachyon::now()->addHours(2);

    expect($tachyon->withinThreeHours())->toBeTrue();
});

test("Within Three Hours is False", function (): void {
    $tachyon = Tachyon::now()->addHours(4);

    expect($tachyon->withinThreeHours())->toBeFalse();
});

test("Is Today is True", function (): void {
    $tachyon = Tachyon::now()->addHours(4);

    expect($tachyon->isToday())->toBeTrue();
});

test("Is Today is False", function (): void {
    $tachyon = Tachyon::now()->addDays(4);

    expect($tachyon->isToday())->toBeFalse();
});
