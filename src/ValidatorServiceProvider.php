<?php

namespace ChickenTikkaMasala\LaraValidator;

use App\Validators\ValidatorInterface;
use ChickenTikkaMasala\LaraValidator\Commands\ValidatorMakeCommand;
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

       $this->addValidators();

       $this->commands([
           ValidatorMakeCommand::class,
       ]);

    }

    /**
     * Loop over all classes in app/Validators and check that class extends AbstractValidator
     */
    protected function addValidators()
    {
        if (\File::exists(app_path('Validators'))) {

            foreach(\File::allFiles(app_path('Validators')) as $validator) {

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
                    return $validatorClass->execute($attribute, $value, $parameters, $validator);
                });

                Validator::replacer($validatorClass->getName(), function($message, $attribute, $rule, $parameters) use ($validatorClass) {
                    return $validatorClass->message($message, $attribute, $rule, $parameters);
                });

            }
        }
    }
}