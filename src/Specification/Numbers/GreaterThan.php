<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:10
 */

namespace Weedus\Specification\Numbers;


use Assert\Assertion;
use Weedus\Specification\AbstractSpecification;

class GreaterThan extends AbstractSpecification
{
    protected $min;

    /**
     * GreaterThan constructor.
     * @param $min
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($min)
    {
        Assertion::numeric($min);
        $this->min = $min;
    }

    /**
     * @param $item
     * @return bool
     * @throws \Assert\AssertionFailedException
     */
    public function isSatisfiedBy($item): bool
    {
        Assertion::numeric($item);
        return $item > $this->min;
    }
}