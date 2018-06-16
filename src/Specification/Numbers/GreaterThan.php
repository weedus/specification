<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:10
 */

namespace Weedus\Specification\Numbers;

class GreaterThan extends AbstractNumberSpecification
{
    protected $min;

    /**
     * GreaterThan constructor.
     * @param $min
     */
    public function __construct($min)
    {
        $this->validate($min);
        $this->min = $min;
    }

    /**
     * @param $item
     * @return bool
     */
    public function isSatisfiedBy($item): bool
    {
        $this->validate($item);
        return $item > $this->min;
    }
}