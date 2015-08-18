# Mizmoz Supermodel

Advanced models for use with your favourite database abstraction layer.

## Basic usage

```php
use Mizmoz\Supermodel\Model;

class User extends Model
{
  // if $fields are defined the default setting is to only allow field names defined in there.
  // We can override this by setting $fieldsAreStrict. Now we have some field names defined but are free to add more
  protected $fieldsAreStrict = false;
  
  // create an array with the field definitions in
  protected function setup()
  {
    return [
      // add name field with validation
      'name' => Type::build('String')->max(10),
      
      // basic type validation
      'age' => Type::build('Integer'),
      
      // email address
      'email' => Type::build('Email')->notEmpty(),
      
      // no validation
      'extra'
    ];
  }
}

// create the object
$user = new User();

// set valid name
$user->name = 'Ian';

// set invalid email, this throws a \Mizmoz\Supermodel\Exceptions\ValidationException
$user->email = '';
```
