<?php

use EncoreDigitalGroup\Tachyon\Tachyon;

test('Source Timezone is America/Chicago', function () {
    $tachyon = new Tachyon('UTC', 'America/Chicago');

    expect($tachyon->getSource())->toBe('America/Chicago');
});

test('Target Timezone is America/Chicago', function () {
    $tachyon = new Tachyon('America/Chicago');

    expect($tachyon->getTarget())->toBe('America/Chicago');
});

test('Change Source Timezone to America/Chicago', function () {
    $tachyon = new Tachyon();
    $tachyon->setSource('America/Chicago');

    expect($tachyon->getSource())->toBe('America/Chicago');
});

test('Change Target Timezone to America/Chicago', function () {
    $tachyon = new Tachyon();
    $tachyon->setTarget('America/Chicago');

    expect($tachyon->getTarget())->toBe('America/Chicago');
});