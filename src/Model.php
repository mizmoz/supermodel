<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel;

use Mizmoz\Supermodel\Traits\Accessor;

abstract class Model
{
    /**
     * Include getter/setter magic methods methods
     *
     */
    use Accessor;

    /**
     * Field definitions cache, leave blank for key => value store type access
     *
     * @var array
     */
    protected static $fieldsCache = [];

    /**
     * Instance field definitions
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Init passing key => value data for the model values
     *
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        // get the field definitions
        $class = get_called_class();
        if (! isset(static::$fieldsCache[$class])) {
            static::$fieldsCache[$class] = $this->setup();
        }

        // load the fields from cache
        $this->fields = static::$fieldsCache[$class];

        // add default values
        $this->fromArray($values, true);
    }

    /**
     * Get the fields
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * This should return a list of fields
     *
     * @return array
     */
    protected function setup()
    {
        return [];
    }

    /**
     * Set values from array
     *
     * @param array $values
     * @return $this
     */
    public function fromArray(array $values)
    {
        foreach ($values as $name => $value) {
            $this->__set($name, $value);
        }
        return $this;
    }
}