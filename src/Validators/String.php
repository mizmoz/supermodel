<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Validators;

use Mizmoz\Supermodel\Contracts\Validators;

class String implements Validators
{
    /**
     * Basic string validation
     *
     * @param $value
     * @return boolean
     */
    public function validate($value)
    {
        return is_string($value);
    }
}