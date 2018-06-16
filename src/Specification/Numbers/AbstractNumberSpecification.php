<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 16.06.18
 * Time: 11:34
 */

namespace Weedus\Specification\Numbers;


use Weedus\Specification\AbstractSpecification;
use Weedus\Exceptions\InvalidArgumentException;

abstract class AbstractNumberSpecification extends AbstractSpecification
{

    protected function validate($value)
    {
        if(!is_numeric($value)){
            throw new InvalidArgumentException('value must be numeric');
        }
    }
}