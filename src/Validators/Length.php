<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Validators;

use Mizmoz\Supermodel\Contracts\Validators;

class Length implements Validators
{
    /**
     * @var integer
     */
    private $min;

    /**
     * @var integer
     */
    private $max;

    /**
     * Set the min and max length of the field
     *
     * @param int $min
     * @param int $max
     */
    public function __construct($min = 0, $max = 0)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $value
     * @return boolean
     */
    public function validate($value)
    {
        $length = strlen($value);
        if ($this->min && $this->min > $length) {
            // too long
            return false;
        }

        if ($this->max && $this->max < $length) {
            return false;
        }

        return true;
    }
}