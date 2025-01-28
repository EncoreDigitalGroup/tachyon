<?php

namespace EncoreDigitalGroup\Tachyon\Support\Timezones;

enum TimezoneGroup: int
{
    case Africa = 1;
    case America = 2;
    case Antarctica = 4;
    case Arctic = 8;
    case Asia = 16;
    case Atlantic = 32;
    case Australia = 64;
    case Europe = 128;
    case Indian = 256;
    case Pacific = 512;
    case Utc = 1024;
    case All = 2047;
    case AllWithBc = 4095;
    case PerCountry = 4096;
}