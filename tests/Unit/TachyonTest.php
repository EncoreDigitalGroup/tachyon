<?php

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
