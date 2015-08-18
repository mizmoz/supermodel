<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests\Validators;

use Mizmoz\Supermodel\Tests\TestCase;
use Mizmoz\Supermodel\Validators\Numeric;

class NumericTest extends TestCase
{
    public function test_numeric()
    {
        $validator = new Numeric();

        // valid numbers
        $this->assertTrue($validator->validate(0));
        $this->assertTrue($validator->validate(123));
        $this->assertTrue($validator->validate('123'));
        $this->assertTrue($validator->validate(123.5));
        $this->assertTrue($validator->validate('123.5'));
        $this->assertTrue($validator->validate(-123.43));

        // invalid numbers
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('string'));
        $this->assertFalse($validator->validate(false));
        $this->assertFalse($validator->validate(null));
    }
}