<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:29
 */

namespace Weedus\Specification\Objects;


use Assert\Assertion;
use Weedus\Specification\AbstractSpecification;

class IsInstance extends AbstractSpecification
{
    /** @var string */
    protected $class;

    /**
     * IsInstance constructor.
     * @param $class
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($class)
    {
        Assertion::string($class);
        $this->class = $class;
    }

    public function isSatisfiedBy($item): bool
    {
        return is_a($item, $this->class);
    }
}