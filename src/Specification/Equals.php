<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 12.06.18
 * Time: 00:07
 */

namespace Weedus\Specification;


class Equals implements SpecificationInterface
{
    protected $item;

    /**
     * Equals constructor.
     * @param $item
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    public function isSatisfiedBy($item): bool
    {
        return $item === $this->item;
    }
}