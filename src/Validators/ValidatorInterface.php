<?php

namespace ChickenTikkaMasala\LaraValidator\Validators;

/**
 * Interface ValidatorInterface
 * @package ChickenTikkaMasala\LaraValidator\Validators
 */
interface ValidatorInterface
{
    public function getName() : string;
    public function execute($attribute, $value, array $parameters, $validator) : bool;
    public function message($message, $attribute, $rule, array $parameters) : string;
}