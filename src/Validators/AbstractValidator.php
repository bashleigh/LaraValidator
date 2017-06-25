<?php

namespace ChickenTikkaMasala\LaraValidator\Validator;

use ChickenTikkaMasala\LaraValidator\Exceptions\InvalidValidatorName;

/**
 * Class AbstractValidator
 * @package ChickenTikkaMasala\LaraValidator\Validator
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @return string
     * @throws InvalidValidatorName
     */
    public function getName(): string
    {
        if (is_null($this->name)) {
            throw new InvalidValidatorName(get_class($this));
        }
        return $this->name;
    }
}