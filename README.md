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

use \ChickenTikkaMasala\LaraValidator\Validator;

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

Add that's pretty much it! It's the simple things ;)

