<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests;

use Mizmoz\Supermodel\Validator;

class ValidatorTest extends TestCase
{
    public function test_resolve_name()
    {
        $this->assertEquals('Mizmoz\Supermodel\Validators\String', Validator::resolve('String'));
    }

    public function test_get_validator()
    {
        $this->assertInstanceOf('\Mizmoz\Supermodel\Validators\String', Validator::getValidator('String'));
    }

    public function test_validator_cache()
    {
        $a = Validator::getValidator('Length');
        $b = Validator::getValidator('Length');
        $c = Validator::getValidator('Length', [0, 10]);
        $d = Validator::getValidator('Length', [10, 0]);

        $this->assertSame($a, $b);
        $this->assertNotSame($a, $c);
        $this->assertNotSame($c, $d);
    }

    public function test_validator()
    {
        $validator = new Validator();
        $validator->add(Validator::getValidator('String'));

        $this->assertTrue($validator->validate('This is a string'));
        $this->assertFalse($validator->validate([]));
    }
}