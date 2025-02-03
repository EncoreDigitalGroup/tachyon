<?php

declare(strict_types=1);

use PHPGenesis\DevUtilities\Rector\Rector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . "/src",
        __DIR__ . "/tests",
    ])
    ->withRules(Rector::rules());
