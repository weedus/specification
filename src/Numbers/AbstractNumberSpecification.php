<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 16.06.18
 * Time: 11:34
 */

namespace Weedus\Specification\Numbers;


use Weedus\Specification\AbstractSpecification;

abstract class AbstractNumberSpecification extends AbstractSpecification
{

    protected function validate($value)
    {
        if(!is_numeric($value)){
            return false;
        }
        return true;
    }
}