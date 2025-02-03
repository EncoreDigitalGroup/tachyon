<?php

use EncoreDigitalGroup\Tachyon\Support\Timezones\Timezone;
use Illuminate\Support\Collection;

test("Timezone List", function (): void {
    $timezones = Timezone::list();

    expect($timezones)->toBeInstanceOf(Collection::class);
});