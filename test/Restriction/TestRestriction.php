<?php

namespace PicoPlaca\Test\Vehicle;

use DateTime;
use PHPUnit\Framework\TestCase;
use PicoPlaca\Restriction\Restriction;

/**
 * Class TestRestriction
 *
 * @package PicoPlaca\Test
 */
class TestRestriction extends TestCase
{
    /**
     * New Restriction instance.
     *
     * @var Restriction
     */
    protected $Restriction;

    protected function setUp()
    {
        $this->Restriction = new Restriction();
    }

    /**
     * Generate random date.
     *
     * @return string
     */
    public function providerDateRandom()
    {
        return date("Y-m-d");
    }

    /**
     * Generate random time.
     *
     * @return string
     */
    public function providerTimeRandom()
    {
        return date("H:i");
    }

    /**
     * Provider array with a date random.
     *
     * @return array
     */
    public function providerArrayWithDate()
    {
        return [[$this->providerDateRandom()]];
    }

    /**
     * Provider array with a date random.
     *
     * @return array
     */
    public function providerArrayWithTime()
    {
        return [[$this->providerTimeRandom()]];
    }

    /**
     * Verify that the date is a string
     * empty when the Restriction
     * instance is create.
     *
     * @covers Car::getDate()
     */
    public function testDateIsInitiallyEmpty()
    {
        $this->assertEmpty($this->Restriction->getDate());
    }

    /**
     * Validate that the value assign at
     * the attribute date is correct.
     *
     * @param string $dateRandom
     *
     * @dataProvider providerArrayWithDate
     * @covers Restriction::setDate()
     */
    public function testAssignAttributeDate($dateRandom)
    {
        $this->Restriction->setDate($dateRandom);

        $this->assertAttributeSame($dateRandom, 'date', $this->Restriction);
    }

    /**
     * Verify that the time is a string
     * empty when the Restriction
     * instance is create.
     *
     * @covers Car::getTime()
     */
    public function testTimeIsInitiallyEmpty()
    {
        $this->assertEmpty($this->Restriction->getTime());
    }

    /**
     * Validate that the value assign at
     * the attribute time is correct.
     *
     * @param string $timeRandom
     *
     * @dataProvider providerArrayWithTime
     * @covers Restriction::setTime()
     */
    public function testAssignAttributeTime($timeRandom)
    {
        $this->Restriction->setTime($timeRandom);

        $this->assertAttributeSame($timeRandom, 'time', $this->Restriction);
    }

    /**
     * Validate that the RegExp returned form
     * Restriction is a RegExp date validate.
     *
     * @covers Restriction::getRegExpDate()
     */
    public function testRestrictionHasRegExpDateValidate()
    {
        // To validate a RegExp returned it again null.
        // If preg_match() return some thing different to false is a RegExp valid.
        $this->assertTrue(preg_match($this->Restriction->getRegExpDate(), null) !== false);
    }

    /**
     * Validate that the RegExp returned form
     * Restriction is a RegExp date validate.
     *
     * @covers Restriction::getRegExpTime()
     */
    public function testRestrictionHasRegExpTimeValidate()
    {
        // To validate a RegExp returned it again null.
        // If preg_match() return some thing different to false is a RegExp valid.
        $this->assertTrue(preg_match($this->Restriction->getRegExpTime(), null) !== false);
    }

    /**
     * Validate that a RegExp supply form Restriction class
     * satisfy the string format.
     *
     * @param string $date
     *
     * @dataProvider providerArrayWithDate
     * @covers Restriction::isValidateDateFormat()
     */
    public function testValidateThatDateSupplyIsCorrect($date)
    {
        // The Car class always receives a license plate number valid.
        $this->Restriction->setDate($date);

        $this->assertTrue($this->Restriction->isValidateDateFormat());
    }

    /**
     * Validate that a RegExp supply form Restriction class
     * satisfy the string format.
     *
     * @param string $time
     *
     * @dataProvider providerArrayWithTime
     * @covers Restriction::isValidateTimeFormat()
     */
    public function testValidateThatTimeSupplyIsCorrect($time)
    {
        // The Car class always receives a license plate number valid.
        $this->Restriction->setTime($time);

        $this->assertTrue($this->Restriction->isValidateTimeFormat());
    }
}