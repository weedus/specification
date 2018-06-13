<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 12.06.18
 * Time: 00:03
 */

namespace Weedus\Specification\Objects;


use Assert\Assertion;
use Weedus\Specification\AbstractSpecification;

class IsClass extends AbstractSpecification
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
        return $this->class === get_class($item);
    }
}