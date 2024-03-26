<?php

namespace EncoreDigitalGroup\Tachyon\Exceptions;

use Throwable;

class InvalidEndTimeProvidedException extends TachyonException
{
    public function __construct(string $message = 'Invalid endTime Provided.', int $code = 1, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
