<?php
namespace Weedus\Tests;

use Assert\Assertion;
use Weedus\Specification\AndSpecification;
use Weedus\Specification\Equals;
use Weedus\Specification\IsType;
use Weedus\Specification\NotSpecification;
use Weedus\Specification\Numbers\GreaterOrEqual;
use Weedus\Specification\Numbers\GreaterThan;
use Weedus\Specification\Numbers\LowerOrEqual;
use Weedus\Specification\Numbers\LowerThan;
use Weedus\Specification\Numbers\NumberBetween;
use Weedus\Specification\Objects\IsClass;
use Weedus\Specification\Objects\IsInstance;
use Weedus\Specification\Objects\UsesTrait;
use Weedus\Specification\OrSpecification;
use Weedus\Tests\Helper\SpecTest1;
use Weedus\Tests\Helper\SpecTest1Child;
use Weedus\Tests\Helper\SpecTest2;
use Weedus\Tests\Helper\SpecTrait1;

class SpecificationTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests

    public function testCanOr()
    {
        $spec1 = new NumberBetween(50, 99);
        $spec2 = new NumberBetween(101, 200);

        $orSpec = new OrSpecification($spec1, $spec2);

        $this->assertFalse($orSpec->isSatisfiedBy(100));
        $this->assertTrue($orSpec->isSatisfiedBy(51));
        $this->assertTrue($orSpec->isSatisfiedBy(150));
    }

    public function testCanAnd()
    {
        $spec1 = new NumberBetween(50, 100);
        $spec2 = new NumberBetween(80, 200);

        $andSpec = new AndSpecification($spec1, $spec2);

        $this->assertFalse($andSpec->isSatisfiedBy(150));
        $this->assertFalse($andSpec->isSatisfiedBy(1));
        $this->assertFalse($andSpec->isSatisfiedBy(51));
        $this->assertTrue($andSpec->isSatisfiedBy(100));
    }

    public function testCanNot()
    {
        $spec1 = new NumberBetween(50, 100);
        $notSpec = new NotSpecification($spec1);

        $this->assertTrue($notSpec->isSatisfiedBy(150));
        $this->assertFalse($notSpec->isSatisfiedBy(50));
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testNumericSpecs()
    {
        $greater = new GreaterThan(0);
        $greaterEqual = new GreaterOrEqual(0);
        $lower = new LowerThan(100);
        $lowerEqual = new LowerOrEqual(100);

        $this->assertTrue($greater->isSatisfiedBy(50));
        $this->assertTrue($greaterEqual->isSatisfiedBy(50));
        $this->assertFalse($greater->isSatisfiedBy(0));
        $this->assertTrue($greaterEqual->isSatisfiedBy(0));
        $this->assertFalse($greater->isSatisfiedBy(-1));
        $this->assertFalse($greaterEqual->isSatisfiedBy(-1));

        $this->assertTrue($lower->isSatisfiedBy(50));
        $this->assertTrue($lowerEqual->isSatisfiedBy(50));
        $this->assertFalse($lower->isSatisfiedBy(100));
        $this->assertTrue($lowerEqual->isSatisfiedBy(100));
        $this->assertFalse($lower->isSatisfiedBy(101));
        $this->assertFalse($lowerEqual->isSatisfiedBy(101));
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testObjectSpecs()
    {
        $test1 = new SpecTest1();
        $test2 = new SpecTest2();
        $test3 = new SpecTest1Child();

        $isInstance = new IsInstance(SpecTest1::class);
        $this->assertTrue($isInstance->isSatisfiedBy($test3));
        $this->assertFalse($isInstance->isSatisfiedBy($test2));
        $this->assertTrue($isInstance->isSatisfiedBy($test1));

        $isClass = new IsClass(SpecTest1::class);
        $this->assertFalse($isClass->isSatisfiedBy($test3));
        $this->assertFalse($isClass->isSatisfiedBy($test2));
        $this->assertTrue($isClass->isSatisfiedBy($test1));

        $isClass = new UsesTrait(SpecTrait1::class);
        $this->assertTrue($isClass->isSatisfiedBy($test3));
        $this->assertFalse($isClass->isSatisfiedBy($test2));
        $this->assertTrue($isClass->isSatisfiedBy($test1));
    }

    public function testEquals()
    {
        $test1 = new SpecTest1();
        $test2 = new SpecTest2();
        $test3 = new SpecTest1Child();
        $origin = new SpecTest1();

        $equals = new Equals($origin);
        $this->assertFalse($equals->isSatisfiedBy($test2));
        $this->assertFalse($equals->isSatisfiedBy($test3));
        $this->assertFalse($equals->isSatisfiedBy($test1));
        $this->assertTrue($equals->isSatisfiedBy($origin));
        $equals = new Equals(10);
        $this->assertFalse($equals->isSatisfiedBy(true));
        $this->assertFalse($equals->isSatisfiedBy(false));
        $this->assertFalse($equals->isSatisfiedBy(13));
        $this->assertFalse($equals->isSatisfiedBy('string'));
        $this->assertTrue($equals->isSatisfiedBy(10));
        $equals = new Equals('string');
        $this->assertFalse($equals->isSatisfiedBy(13));
        $this->assertFalse($equals->isSatisfiedBy(10));
        $this->assertFalse($equals->isSatisfiedBy('bla'));
        $this->assertTrue($equals->isSatisfiedBy('string'));
        $equals = new Equals(false);
        $this->assertFalse($equals->isSatisfiedBy(true));
        $this->assertFalse($equals->isSatisfiedBy(10));
        $this->assertFalse($equals->isSatisfiedBy('bla'));
        $this->assertTrue($equals->isSatisfiedBy(false));
        $equals = new Equals(true);
        $this->assertFalse($equals->isSatisfiedBy(false));
        $this->assertFalse($equals->isSatisfiedBy(10));
        $this->assertFalse($equals->isSatisfiedBy('bla'));
        $this->assertTrue($equals->isSatisfiedBy(true));
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testType()
    {
        $int = (int)1;
        $double = (double)1.5;
        $string = 'string';
        $object = new \stdClass();

        $isInteger = new IsType('integer');
        $isDouble = new IsType('double');
        $isString = new IsType('string');
        $isObject = new IsType('object');

        try {
            new IsType('float');
        }catch(\Exception $exception){
            $this->assertContains('float not possible',$exception->getMessage());
        }


        $this->assertTrue($isInteger->isSatisfiedBy($int));
        $this->assertFalse($isInteger->isSatisfiedBy($double));
        $this->assertFalse($isInteger->isSatisfiedBy($string));
        $this->assertFalse($isInteger->isSatisfiedBy($object));

        $this->assertFalse($isDouble->isSatisfiedBy($int));
        $this->assertTrue($isDouble->isSatisfiedBy($double));
        $this->assertFalse($isDouble->isSatisfiedBy($string));
        $this->assertFalse($isDouble->isSatisfiedBy($object));

        $this->assertFalse($isString->isSatisfiedBy($int));
        $this->assertFalse($isString->isSatisfiedBy($double));
        $this->assertTrue($isString->isSatisfiedBy($string));
        $this->assertFalse($isString->isSatisfiedBy($object));

        $this->assertFalse($isObject->isSatisfiedBy($int));
        $this->assertFalse($isObject->isSatisfiedBy($double));
        $this->assertFalse($isObject->isSatisfiedBy($string));
        $this->assertTrue($isObject->isSatisfiedBy($object));
    }
}