<?php

namespace ChickenTikkaMasala\LaraValidator\Validator;

/**
 * Interface ValidatorInterface
 * @package ChickenTikkaMasala\LaraValidator\Validator
 */
interface ValidatorInterface
{
    public function getName() : string;
    public function execute($attribute, $value, array $parameters, $validator) : boolean;
    public function message($message, $attribute, $rule, array $parameters) : string;
}