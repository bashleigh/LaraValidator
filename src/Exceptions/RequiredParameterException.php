<?php

namespace ChickenTikkaMasala\LaraValidator\Exceptions;

use Throwable;

/**
 * Class InvalidParameterException
 * @package ChickenTikkaMasala\LaraValidator\Exceptions
 */
class RequiredParameterException extends \Exception
{
    /**
     * RequiredParameterException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct('The parameter "'.$message.'" is required.', $code, $previous);
    }
}