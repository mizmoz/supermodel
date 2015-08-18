<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Contracts;

interface Validator
{
    /**
     * Add a validation object to the validator
     *
     * @param Validators $validator
     * @return mixed
     */
    public function add(Validators $validator);

    /**
     * Validate the $value
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value);

    /**
     * Resolve the validator the validator
     *
     * @param $name
     * @param array $options
     * @return Validators
     */
    public static function getValidator($name, array $options = []);
}