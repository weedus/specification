<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 22:30
 */

namespace Weedus\Specification\Numbers;


use Weedus\Specification\SpecificationInterface;

class NumberBetweenSpecification implements SpecificationInterface
{
    /**
     * @var float|null
     */
    private $max;

    /**
     * @var float|null
     */
    private $min;

    /**
     * @param float $minPrice
     * @param float $maxPrice
     */
    public function __construct(float $min, float $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function isSatisfiedBy($item): bool
    {
        if ($this->max !== null && $item > $this->max) {
            return false;
        }

        if ($this->min !== null && $item < $this->min) {
            return false;
        }

        return true;
    }
}