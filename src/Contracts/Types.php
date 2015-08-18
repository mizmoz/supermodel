<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Contracts;

interface Types
{
    /**
     * Should return an array of validators
     *
     * @return array
     */
    public function validators();
}