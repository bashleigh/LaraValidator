## Installation 

Add the service provider to your providers array in `config/app.php`

```php
'providers' => [
    ...
    ChickenTikkaMasala\LaraValidator\ValidatorServiceProvider::class,
    ...
 ];
```

Now create a class that extends AbstractValidator in `App\Validators`;

```php
<?php

namespace App\Validators;

use \ChickenTikkaMasala\LaraValidator\Validators\AbstractValidator;

class CustomValidator extends AbstractValidator
{
    public $name = 'custom';
    
    public function execute($attribute, $value, array $parameters, $validator) : boolean {
        return true;
    }
    
    public function message($message, $attribute, $rule, array $parameters) : string {
        return 'your custom validation failed';
    }
}

```

Now use your custom validation like 

```php
public $rules = [
    'field' => 'custom',
];

```

### Validating parameters 

I've added a small exception throwing function that 'validates' the parameters passed.

```php
public function execute($attribute, $value, array $parameters, $validator) : boolean {
    $this->validateParameters($parameters, [
        0 => 'table name',
    ]);
}
```

Now if we did this with our custom validator 

```php
public $rules = [
    'field' => 'custom',
];

```
We would get an exception 

```php
RequiredParameterException in AbstractValidator.php line 40:
The parameter "table name" is required.
```

And that's pretty much it! It's the simple things ;)

