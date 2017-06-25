<?php

namespace ChickenTikkaMasala\LaraValidator\Validators;

use ChickenTikkaMasala\LaraValidator\Exceptions\InvalidValidatorNameException;
use ChickenTikkaMasala\LaraValidator\Exceptions\RequiredParameterException;

/**
 * Class AbstractValidator
 * @package ChickenTikkaMasala\LaraValidator\Validators
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @return string
     * @throws InvalidValidatorNameException
     */
    public function getName(): string
    {
        if (is_null($this->name)) {
            throw new InvalidValidatorNameException(get_class($this));
        }
        return $this->name;
    }

    /**
     * @param array $parameters
     * @param array $expected
     * @throws RequiredParameterException
     */
    public function validateParameters(array $parameters, array $expected)
    {
        foreach($expected as $key => $name) {
            if (!isset($parameters[$key])) {
                throw new RequiredParameterException(!is_null($name) ? $name : 'with key '.$key);
            }
        }
    }
}