<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel;

use Mizmoz\Supermodel\Contracts\Types;
use Mizmoz\Supermodel\Contracts\Validators;
use Mizmoz\Supermodel\Exceptions\InvalidTypeException;
use Mizmoz\Supermodel\Traits\TypeValidators;

class Type
{
    use TypeValidators;

    /**
     * Path to the Types directory
     *
     * @var string
     */
    const TYPES_PATH = __NAMESPACE__ . '\\Types\\';

    /**
     * Validator resolver callback
     *
     * @var callable
     */
    private static $validatorResolver;

    /**
     * @var Types
     */
    private $type;

    /**
     * @var \Mizmoz\Supermodel\Contracts\Validator
     */
    private $validator;

    /**
     * @param Types $type
     */
    public function __construct(Types $type)
    {
        $this->type = $type;
        $this->validator = static::resolveValidator();
        $this->with($this->type->validators());
    }

    /**
     * Resolve the Validator, used for switching out the default validator
     *
     * @param callback $callback
     * @return Validator
     */
    public static function resolveValidator($callback = null)
    {
        if (is_null($callback) && is_callable(static::$validatorResolver)) {
            $callback = static::$validatorResolver;
            return $callback();
        }

        if (is_string($callback)) {
            static::$validatorResolver = $callback;
        }

        return new Validator();
    }

    /**
     * Get the type
     *
     * @return Types
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Build the Type from the provided string
     *
     * @param $type
     * @return Type
     */
    public static function build($type)
    {
        if (! $type instanceof Types) {
            if (! in_array($type, ['String', 'Integer'])) {
                throw new InvalidTypeException('Invalid type: ' . $type);
            }

            $name = self::TYPES_PATH . $type;
            $type = new $name();
        }

        return new static($type);
    }

    /**
     * Add a validator
     *
     * @param mixed $validator
     * @param array $options
     * @return $this
     */
    public function with($validator, array $options = [])
    {

        if ($validator instanceof Validators) {
            $this->validator->add($validator);
        } else if (is_string($validator)) {
            $this->validator->add(Validator::getValidator($validator, $options));
        } else if (is_array($validator)) {
            array_map(function ($v) use ($options) {
                $this->with($v, $options);
            }, $validator);
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * Validate the type
     *
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        return $this->validator->validate($value);
    }
}