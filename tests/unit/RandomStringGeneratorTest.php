<?php


use AppBundle\Util\RandomStringGenerator;

class RandomStringGeneratorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testRandomStringLength()
    {
        $string = RandomStringGenerator::generateString(10);

        $this->assertEquals(10, strlen($string));
    }

    public function testRandomStringOnlyAlphanumeric()
    {
        $string = RandomStringGenerator::generateString(10, true);

        $this->assertRegExp('/^[a-zA-Z0-9]*$/', $string);
    }
}