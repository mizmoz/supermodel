<?php
/**
 * @package Mizmoz
 * @copyright Copyright 2015 Mizmoz Limited - Released under the MIT license
 * @see https://www.mizmoz.com/labs/supermodel
 */

namespace Mizmoz\Supermodel\Tests\Models;

use Mizmoz\Supermodel\Model;
use Mizmoz\Supermodel\Type;

class BasicFields extends Model
{
    /**
     * Only allow the defined fields to be used
     *
     * @var bool
     */
    protected static $strictDefinitions = true;

    /**
     * Setup the model
     *
     * @return array
     */
    protected function setup()
    {
        return [
            'name' => Type::build('String')->max(10),
            'age' => Type::build('Integer')
        ];
    }
}