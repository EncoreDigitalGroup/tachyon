<?php

namespace EncoreDigitalGroup\Tachyon\Exceptions;

use Throwable;

class InvalidStartTimeProvidedException extends TachyonException
{
    public function __construct(string $message = "Invalid startTime Provided.", int $code = 1, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
