<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 12.06.18
 * Time: 00:03
 */

namespace Weedus\Specification\Objects;

class IsClass extends AbstractObjectSpecification
{
    /** @var string */
    protected $class;

    /**
     * IsClass constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->validateString($class);
        $this->class = $class;
    }

    public function isSatisfiedBy($item): bool
    {
        $this->validateObject($item);
        return $this->class === get_class($item);
    }
}