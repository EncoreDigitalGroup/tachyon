<?php

use Carbon\Carbon;
use EncoreDigitalGroup\Tachyon\Tachyon;

test('Time Diff is 60 Seconds', function () {
    $targetDateTime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->addSeconds(60)->format('Y-m-d H:i:s'));
    
    $tachyon = new Tachyon();

    expect($tachyon->unixDiffInSeconds($targetDateTime))->toBe(60);
});