<?php
namespace Weedus\Tests;

use Weedus\Specification\AndSpecification;
use Weedus\Specification\NotSpecification;
use Weedus\Specification\Numbers\NumberBetweenSpecification;
use Weedus\Specification\OrSpecification;

class SpecificationTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testCanOr()
    {
        $spec1 = new NumberBetweenSpecification(50, 99);
        $spec2 = new NumberBetweenSpecification(101, 200);

        $orSpec = new OrSpecification($spec1, $spec2);

        $this->assertFalse($orSpec->isSatisfiedBy(100));
        $this->assertTrue($orSpec->isSatisfiedBy(51));
        $this->assertTrue($orSpec->isSatisfiedBy(150));
    }

    public function testCanAnd()
    {
        $spec1 = new NumberBetweenSpecification(50, 100);
        $spec2 = new NumberBetweenSpecification(80, 200);

        $andSpec = new AndSpecification($spec1, $spec2);

        $this->assertFalse($andSpec->isSatisfiedBy(150));
        $this->assertFalse($andSpec->isSatisfiedBy(1));
        $this->assertFalse($andSpec->isSatisfiedBy(51));
        $this->assertTrue($andSpec->isSatisfiedBy(100));
    }

    public function testCanNot()
    {
        $spec1 = new NumberBetweenSpecification(50, 100);
        $notSpec = new NotSpecification($spec1);

        $this->assertTrue($notSpec->isSatisfiedBy(150));
        $this->assertFalse($notSpec->isSatisfiedBy(50));
    }
}