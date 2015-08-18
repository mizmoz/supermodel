<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests;

use Mizmoz\Supermodel\Type;

class TypeTest extends TestCase
{
    public function test_factory_creation()
    {
        $type = Type::build('String');
        $this->assertInstanceOf('\Mizmoz\Supermodel\Types\String', $type->getType());
    }

    public function test_validation()
    {
        $type = Type::build('String');
        $this->assertTrue($type->validate('This is a string'));
    }

    public function test_add_max()
    {
        $type = Type::build('String')->max(10);
        $this->assertTrue($type->validate('Short'));
        $this->assertFalse($type->validate('This is too long'));
    }
}