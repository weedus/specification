<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:14
 */

namespace Weedus\Specification\Numbers;

class GreaterOrEqual extends AbstractNumberSpecification
{
    protected $min;

    /**
     * GreaterOrEqual constructor.
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
        return $item >= $this->min;
    }

}