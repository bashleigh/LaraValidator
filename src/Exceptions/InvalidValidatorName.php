<?php

namespace ChickenTikkaMasala\LaraValidator\Exceptions;

use Throwable;

/**
 * Class InvalidValidatorName
 * @package ChickenTikkaMasala\LaraValidator\Exceptions
 */
class InvalidValidatorName extends \Exception
{
    /**
     * InvalidValidatorName constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct('The validator "'.$message.'" requires the name parameter not to be null', $code, $previous);
    }
}