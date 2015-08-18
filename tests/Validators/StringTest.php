<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests\Validators;

use Mizmoz\Supermodel\Tests\TestCase;
use Mizmoz\Supermodel\Validators\String;

class StringTest extends TestCase
{
    public function test_string()
    {
        $validator = new String();

        // valid string
        $this->assertTrue($validator->validate('Hello'));
        $this->assertTrue($validator->validate('123'));

        // invalid string
        $this->assertFalse($validator->validate(123));
        $this->assertFalse($validator->validate(false));
        $this->assertFalse($validator->validate([]));
        $this->assertFalse($validator->validate(new \stdClass()));
    }
}