<?php

use EncoreDigitalGroup\Tachyon\Support\TimestampFormat;
use EncoreDigitalGroup\Tachyon\Tachyon;

test("Timezone is America/Chicago", function (): void {
    $tachyon = new Tachyon;
    $tachyon->setTimezone("America/Chicago");

    expect($tachyon->getTimezone()->getName())->toBe("America/Chicago");
});

test("Target Timezone to America/Chicago", function (): void {
    $tachyon = new Tachyon;
    $tachyon->setTargetTimezone("America/Chicago");

    expect($tachyon->getTimezone()->getName())->toBe("America/Chicago");
});

test("fromArrayIndex returns correct date", function (): void {
    $array = ["date" => "12/31/2023"];
    $date = Tachyon::fromArrayIndex($array, "date", "m/d/Y");

    expect($date)->not->toBeNull();
    expect($date->format("Y-m-d"))->toBe("2023-12-31");
});

test("fromArrayIndex returns null for invalid date", function (): void {
    $array = ["date" => "invalid-date"];
    $date = Tachyon::fromArrayIndex($array, "date", "m/d/Y");

    expect($date)->toBeNull();
});

test("mdyFromArrayIndex returns correct date", function (): void {
    $array = ["date" => "02/02/25"];
    $date = Tachyon::mdyFromArrayIndex($array, "date");

    expect($date)->not->toBeNull()
        ->and($date->format(TimestampFormat::MDY))->toBe("02/02/25");
});

test("mdyFromArrayIndex returns null for invalid date", function (): void {
    $array = ["date" => "invalid-date"];
    $date = Tachyon::mdyFromArrayIndex($array, "date");

    expect($date)->toBeNull();
});
