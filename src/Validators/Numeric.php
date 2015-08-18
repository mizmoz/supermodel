<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Validators;

use Mizmoz\Supermodel\Contracts\Validators;

class Numeric implements Validators
{
    /**
     * Check the value is numeric
     *
     * @param $value
     * @return boolean
     */
    public function validate($value)
    {
        return is_numeric($value);
    }
}