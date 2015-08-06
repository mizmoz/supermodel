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
    
    // email field, we'll add some customer validation below using validateEmail()
    'email' => self::type(self::EMAIL),
    
    // this uses external validation
    'postcode' => self::type(self::CUSTOM)->use('ValidatePost'),
    
    // add basic field with no validation
    'extra'
  ];
  
  /**
   * Validate the email address before adding to the model
   * @param string $value
   * @param string $type
   */
  public function validateEmail($value, $type)
  {
    // some custom validation
    return (strpos($value, '@') !== false);
  }
}

// Add custom validator globally
Model::addValidator(function ($field, $value, $type) {
  return true;
});

// User only validator
User::addValidator(function ($field, $value, $type) {
  return true;
});

$user = new User();
```
