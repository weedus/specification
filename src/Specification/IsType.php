<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 12.06.18
 * Time: 00:32
 */

namespace Weedus\Specification;


use Assert\Assertion;

class IsType extends AbstractSpecification
{
    protected $type;

    /**
     * IsType constructor.
     * @param $type
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($type)
    {
        Assertion::string($type);
        Assertion::notEq($type, 'float', 'float not possible');
        $this->type = $type;
    }

    public function isSatisfiedBy($item): bool
    {
        return gettype($item) === $this->type;
    }
}