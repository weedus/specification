<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:16
 */

namespace Weedus\Specification\Numbers;


use Assert\Assertion;
use Weedus\Specification\SpecificationInterface;

class LowerOrEqual implements SpecificationInterface
{
    protected $max;

    /**
     * LowerThan constructor.
     * @param $max
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($max)
    {
        Assertion::numeric($max);
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
        return $item <= $this->max;
    }
}