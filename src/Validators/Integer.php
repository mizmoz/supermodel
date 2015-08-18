<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Validators;

use Mizmoz\Supermodel\Contracts\Validators;

class Integer implements Validators
{
    /**
     * Check the value is an integer
     *
     * @param $value
     * @return boolean
     */
    public function validate($value)
    {
        // allows strings like 23 to pass as an int
        return (bool)preg_match('/^[-]{0,1}[0-9]{1,20}$/', $value, $results);
    }
}