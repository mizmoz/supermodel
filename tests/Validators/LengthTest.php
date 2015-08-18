<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests\Validators;

use Mizmoz\Supermodel\Tests\TestCase;
use Mizmoz\Supermodel\Validators\Length;

class LengthTest extends TestCase
{
    public function test_max_length()
    {
        $validator = new Length(0, 10);

        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate('Hello'));
        $this->assertTrue($validator->validate('Just Space'));
        $this->assertFalse($validator->validate('This is too long'));
    }

    public function test_min_length()
    {
        $validator = new Length(10);

        $this->assertTrue($validator->validate('This is long enough'));
        $this->assertTrue($validator->validate('Just Space'));
        $this->assertFalse($validator->validate('Too small'));
    }

    public function test_range()
    {
        $validator = new Length(5, 10);

        $this->assertTrue($validator->validate('Small'));
        $this->assertTrue($validator->validate('Just Space'));
        $this->assertFalse($validator->validate('This is too big'));
    }
}