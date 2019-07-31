<?php

namespace DansMaCulotte\LaPoste\Exceptions;

class Exception extends \Exception
{
    /**
     * @param string $message
     * @return Exception
     */
    public static function trackingError(string $message)
    {
        return new self("Tracking request returned an error: ${message}");
    }
}
