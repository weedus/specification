<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 11.06.18
 * Time: 23:41
 */

namespace Weedus\Specification\Objects;

class UsesTrait extends AbstractObjectSpecification
{
    protected $trait;

    /**
     * UsesTrait constructor.
     * @param $trait
     */
    public function __construct($trait)
    {
        $this->validateString($trait);
        $this->trait = $trait;
    }

    public function isSatisfiedBy($item): bool
    {
        if(!$this->validateObject($item)){
            return false;
        }
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