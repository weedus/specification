<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 22:30
 */

namespace Weedus\Specification\Numbers;

class NumberBetween extends AbstractNumberSpecification
{
    /**
     * @var number
     */
    private $max;

    /**
     * @var number
     */
    private $min;

    /**
     * NumberBetween constructor.
     * @param $min
     * @param $max
     */
    public function __construct($min, $max)
    {
        $this->validate($min);
        $this->validate($max);
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $item
     * @return bool
     */
    public function isSatisfiedBy($item): bool
    {
        if(!$this->validate($item)){
            return false;
        }
        if ($this->max !== null && $item > $this->max) {
            return false;
        }

        if ($this->min !== null && $item < $this->min) {
            return false;
        }

        return true;
    }
}