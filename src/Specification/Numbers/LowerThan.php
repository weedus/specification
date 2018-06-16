<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:10
 */

namespace Weedus\Specification\Numbers;

class LowerThan extends AbstractNumberSpecification
{
    protected $max;

    /**
     * LowerThan constructor.
     * @param $max
     */
    public function __construct($max)
    {
        $this->validate($max);
        $this->max = $max;
    }

    /**
     * @param $item
     * @return bool
     */
    public function isSatisfiedBy($item): bool
    {
        $this->validate($item);
        return $item < $this->max;
    }
}