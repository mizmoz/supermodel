<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Traits;

use Mizmoz\Supermodel\Exceptions\InvalidFieldException;

trait Accessor
{
    /**
     * Key => value store for the model values
     *
     * @var array
     */
    protected $values = [];

    /**
     * Set the model value for a key
     *
     * @param $name
     * @param $value
     * @throws InvalidFieldException
     */
    public function __set($name, $value)
    {
        if (! $this->fieldNameIsValid($name)) {
            throw new InvalidFieldException($name);
        }

        $this->values[$name] = $value;
    }

    /**
     * Get a model value for a key
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (! $this->fieldNameIsValid($name)) {
            throw new InvalidFieldException($name);
        }

        return (isset($this->values[$name]) ? $this->values[$name] : null);
    }

    /**
     * Magic setter/getter methods
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        switch (count($arguments)) {
            case 0:
                return $this->__get($name);
            case 1:
                $this->__set($name, $arguments[0]);
                return $this;
            default:
                throw new \InvalidArgumentException();
        }
    }

    /**
     * Check if the field name is valid
     *
     * @param $name
     * @return boolean
     */
    private function fieldNameIsValid($name)
    {
        return (! $this->hasStrictDefinitions() || isset($this->fields[$name]));
    }

    /**
     * Does this Model has strict field definitions?
     *
     * @return boolean
     */
    public function hasStrictDefinitions()
    {
        $static = get_called_class();
        return (isset($static::$strictDefinitions) && $static::$strictDefinitions);
    }
}