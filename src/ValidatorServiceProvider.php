<?php

namespace ChickenTikkaMasala\LaraValidator;

use App\Validators\ValidatorInterface;
use ChickenTikkaMasala\LaraValidator\Validators\AbstractValidator;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\Validator;

/**
 * Class ValidatorServiceProvider
 * @package ChickenTikkaMasala\LaraValidator
 */
class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        /**
         * Loop over all classes in app/Validators and check that class extends AbstractValidator 
         */
        foreach(\File::allFiles('app/Validators') as $validator) {

            /** @var SplFileInfo $validator */
            $class = 'App\Validators\\'.str_replace('.php', '', $validator->getFilename());

            /** @var \ReflectionClass $classInfo */
            $classInfo = new \ReflectionClass($class);

            $parentClass = $classInfo->getParentClass();

            if (!$parentClass) continue;

            if ($parentClass->getName() !== AbstractValidator::class) continue;

            /** @var ValidatorInterface $validatorClass */
            $validatorClass = app($class);

            Validator::extend($validatorClass->getName(), function($attribute, $value, $parameters, $validator) use ($validatorClass) {
                $validatorClass->execute($attribute, $value, $parameters, $validator);
            });

            Validator::replacer($validatorClass->getName(), function($message, $attribute, $rule, $parameters) use ($validatorClass) {
                $validatorClass->message($message, $attribute, $rule, $parameters);
            });

        }

        exit;

    }
}