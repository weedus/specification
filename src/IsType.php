<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 12.06.18
 * Time: 00:32
 */

namespace Weedus\Specification;

use Weedus\Exceptions\InvalidArgumentException;

class IsType extends AbstractSpecification
{
    protected $type;

    /**
     * IsType constructor.
     * @param $type
     */
    public function __construct($type)
    {
        if(!is_string($type)){
            throw new InvalidArgumentException('must be string');
        }
        $this->type = $type;
    }

    public function isSatisfiedBy($item): bool
    {
        return gettype($item) === $this->type;
    }
}