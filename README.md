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

  // field definitions are optional, without them Supermodel acts as a key => value store
  protected $fields = [
  
    // add name field with validation
    'name' => self::type(self::STRING)->max(10)->notEmpty(),
    
    // add basic field with no validation
    'extra'
  ];
}

$user = new User();
```
