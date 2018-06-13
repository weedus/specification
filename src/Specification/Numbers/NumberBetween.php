<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 22:30
 */

namespace Weedus\Specification\Numbers;

use Assert\Assertion;
use Weedus\Specification\AbstractSpecification;

class NumberBetween extends AbstractSpecification
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
        Assertion::allNumeric([$min,$max]);
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $item
     * @return bool
     * @throws \Assert\AssertionFailedException
     */
    public function isSatisfiedBy($item): bool
    {
        Assertion::numeric($item);
        if ($this->max !== null && $item > $this->max) {
            return false;
        }

        if ($this->min !== null && $item < $this->min) {
            return false;
        }

        return true;
    }
}