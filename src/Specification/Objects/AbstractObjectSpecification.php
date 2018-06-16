<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 16.06.18
 * Time: 11:40
 */

namespace Weedus\Specification\Objects;


use Weedus\Specification\AbstractSpecification;
use Weedus\Exceptions\InvalidArgumentException;

abstract class AbstractObjectSpecification extends AbstractSpecification
{
    protected function validateString($string){
        if(!is_string($string)){
            throw new InvalidArgumentException('must be string');
        }
    }
    protected function validateObject($object){
        if(!is_object($object)){
            throw new InvalidArgumentException('must be Object');
        }
    }
}