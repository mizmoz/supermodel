<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel;

use Mizmoz\Supermodel\Contracts\Validators;
use Mizmoz\Supermodel\Exceptions\UnableToResolveValidatorException;

class Validator implements \Mizmoz\Supermodel\Contracts\Validator
{
    const PATH = __NAMESPACE__ . '\\Validators\\';

    /**
     * Validator cache
     *
     * @var Validators[]
     */
    private static $validatorsCache = [];

    /**
     * Instance validators
     *
     * @var validators[]
     */
    private $validators = [];

    /**
     * Add a validation object to the validator
     *
     * @param Validators $validator
     * @return mixed
     */
    public function add(Validators $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * Validate the $value
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value)
    {
        foreach ($this->validators as $validate) {
            if (! $validate->validate($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validator cache tag
     *
     * @param string $name
     * @param array $options
     * @return string
     */
    public static function tag($name, array $options)
    {
        return md5($name . '-' . serialize($options));
    }

    /**
     * Resolve the validator from the string
     *
     * @param $name
     * @return string
     */
    public static function resolve($name)
    {
        $name = str_replace('-', '\\', $name);

        // look in the Validators path first
        if (class_exists(self::PATH . $name)) {
            $class = self::PATH . $name;
        } else if (class_exists($name)) {
            $class = $name;
        } else {
            throw new UnableToResolveValidatorException($name);
        }

        return $class;
    }

    /**
     * Get a validator instance
     *
     * @param string $name
     * @param array $options
     * @return \Mizmoz\Supermodel\Contracts\Validators
     */
    public static function getValidator($name, array $options = [])
    {
        $tag = static::tag($name, $options);
        if (! isset(static::$validatorsCache[$tag])) {
            // create the validator instance
            $class = static::resolve($name);
            $reflect = new \ReflectionClass($class);
            static::$validatorsCache[$tag] = $reflect->newInstanceArgs($options);
        }

        return static::$validatorsCache[$tag];
    }
}