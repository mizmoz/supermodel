<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests\Models;

use Mizmoz\Supermodel\Tests\TestCase;

class AccessorTest extends TestCase
{
    public function test_magic_get_set_methods()
    {
        $model = new Basic();
        $model->name = 'Ian';
        $model->age = 26;

        $this->assertSame('Ian', $model->name);
        $this->assertSame(26, $model->age);
    }

    public function test_magic_call_methods()
    {
        $model = new Basic();
        $model->name('Ian')
            ->age(26);

        $this->assertSame('Ian', $model->name());
        $this->assertSame(26, $model->age());
    }

    public function test_init_with_values()
    {
        $model = new Basic(['name' => 'Ian', 'age' => 26]);

        $this->assertSame('Ian', $model->name);
        $this->assertSame(26, $model->age);
    }

    public function test_access_valid_fields()
    {
        $model = new BasicFields();
        $model->age = 34;
        $model->name = 'Ian';

        $this->assertSame('Ian', $model->name);
        $this->assertSame(34, $model->age);
    }

    public function test_access_to_invalid_fields()
    {
        $this->setExpectedException('Mizmoz\Supermodel\Exceptions\InvalidFieldException', 'not_a_defined_field');

        $model = new BasicFields();
        $model->not_a_defined_field = 'Hello';
    }
}