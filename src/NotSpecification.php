<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 22:19
 */

namespace Weedus\Specification;


class NotSpecification extends AbstractSpecification
{
    /**
     * @var SpecificationInterface
     */
    private $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy($item): bool
    {
        return !$this->specification->isSatisfiedBy($item);
    }
}