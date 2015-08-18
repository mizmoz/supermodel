<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests\Models;

use Mizmoz\Supermodel\Tests\TestCase;

class BasicFieldsTest extends TestCase
{
    public function test_field_init()
    {
        $basic = new Basic();
        $basicFields = new BasicFields();

        // make sure nothing bad is happening with the static cache
        $this->assertNotSame($basic->getFields(), $basicFields->getFields());
    }
}