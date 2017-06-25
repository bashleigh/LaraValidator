<?php

namespace ChickenTikkaMasala\LaraValidator;

use App\Validators\ValidatorInterface;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\SplFileInfo;
use Validator;
use File;

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
        foreach(File::allFiles('app/Validators') as $validator) {

            /** @var SplFileInfo $validator */
            $class = 'App\Validators\\'.str_replace('.php', '', $validator->getFilename());

            /** @var \ReflectionClass $classInfo */
            $classInfo = new \ReflectionClass($class);

            $parentClass = $classInfo->getParentClass();

            if (!$parentClass) continue;

            if ($parentClass->getName() !== 'App\Validators\AbstractValidator') continue;


            /** @var ValidatorInterface $validatorClass */
            $validatorClass = app($class);

            Validator::extends($validatorClass->getName(), function($attribute, $value, $parameters, $validator) use ($validatorClass) {
                $validatorClass->execute($attribute, $value, $parameters, $validator);
            });

            Validator::replacer($validatorClass->getName(), function($message, $attribute, $rule, $parameters) use ($validatorClass) {
                $validatorClass->message($message, $attribute, $rule, $parameters);
            });

        }

    }
}