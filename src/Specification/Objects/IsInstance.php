<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:29
 */

namespace Weedus\Specification\Objects;

class IsInstance extends AbstractObjectSpecification
{
    /** @var string */
    protected $class;

    /**
     * IsInstance constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->validateString($class);
        $this->class = $class;
    }

    public function isSatisfiedBy($item): bool
    {
        if(!$this->validateObject($item)){
            return false;
        }
        return is_a($item, $this->class);
    }
}