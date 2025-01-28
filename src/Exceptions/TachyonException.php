<?php

namespace EncoreDigitalGroup\Tachyon\Exceptions;

use Exception;
use Throwable;

class TachyonException extends Exception
{
    public function __construct(string $message = "Tachyon Encountered an Internal Error.", int $code = 1, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
