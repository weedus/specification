<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:41
 */

namespace Weedus\Specification\Objects;


use Assert\Assertion;
use Weedus\Specification\SpecificationInterface;

class UsesTrait implements SpecificationInterface
{
    protected $trait;

    /**
     * UsesTrait constructor.
     * @param $trait
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($trait)
    {
        Assertion::string($trait);
        $this->trait = $trait;
    }

    public function isSatisfiedBy($item): bool
    {
        Assertion::isObject($item);
        $items = $this->getParentClasses($item);
        foreach($items as $item){
            $traits = class_uses($item);
            if($traits && in_array($this->trait,$traits)){
                return true;
            }
        }
        return false;
    }

    protected function getParentClasses($item)
    {
        $items =[];
        $items[] = $item;
        while(get_parent_class($item)){
            $item = get_parent_class($item);
            $items[] = $item;
        }
        return $items;
    }
}