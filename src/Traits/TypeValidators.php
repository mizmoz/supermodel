<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Traits;

trait TypeValidators
{
    /**
     * @param $validator
     * @param array $options
     * @return $this
     */
    abstract public function with($validator, array $options = []);

    /**
     * Set the min length
     *
     * @param $value
     * @return $this
     */
    public function min($value)
    {
        return $this->with('Length', [$value, 0]);
    }

    /**
     * Set the max length
     *
     * @param $value
     * @return $this
     */
    public function max($value)
    {
        return $this->with('Length', [0, $value]);
    }
}