<?php

namespace Weedus\Specification;

interface SpecificationInterface
{
    public function isSatisfiedBy($item): bool;
}
