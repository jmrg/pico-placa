<?php

namespace PicoPlaca\Test\Vehicle;

use PHPUnit\Framework\TestCase;
use PicoPlaca\Restriction\Restriction;
use PicoPlaca\Vehicle\Car;

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
        // New Car instance.
        $Car = new Car();
        $Car->setPlate('GSD-2741'); // Example plate.

        $this->Restriction = new Restriction($Car);
    }

    /**
     * Return a license plate number valid
     * for date today.
     *
     * @return string
     */
    public function getPlateValidToday()
    {

        // Generate the last digit corresponding to current day.
        $lastDigit = '';
        $day = date('D');

        if (array_key_exists($day, Restriction::getCalendarApplication())) {
            $lastDigit = reset(Restriction::getCalendarApplication()[$day]);
        }

        // Construct license plate number.
        return $plate = 'GSD-274'.$lastDigit;
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
     * Provider array with days.
     *
     * @return array
     */
    public function providerArrayWithDaysOfApplication()
    {
        return [
            ['Mon'],
            ['Tue'],
            ['Wed'],
            ['Thu'],
            ['Fri'],
        ];
    }

    /**
     * Provider array with day shifts.
     *
     * @return array
     */
    public function providerArrayWithShiftsOfApplication()
    {
        return [
            ['morning'],
            ['afternoon']
        ];
    }

    /**
     * Verifies that the date is a string
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
     * Verifies that the time is a string
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
        $this->assertTrue($this->Restriction->isValidateDateFormat($date));
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
        $this->assertTrue($this->Restriction->isValidateTimeFormat($time));
    }

    /**
     * Verifies that the calendar application
     * returned is array.
     *
     * @covers Restriction::getCalendarApplication()
     */
    public function testCalendarRestrictionReturnedArray()
    {
        $this->assertTrue(is_array(Restriction::getCalendarApplication()));
    }

    /**
     * Verifies that the array with restrictions days contains
     * the days: Mon, Tue, Wed, Sat, Fri.
     *
     * @param string $day
     *
     * @dataProvider providerArrayWithDaysOfApplication
     * @covers Restriction::getCalendarApplication()
     */
    public function testCalendarRestrictionContainsDays($day)
    {
        $this->assertArrayHasKey($day, Restriction::getCalendarApplication());
    }

    /**
     * Verifies that the shifts application
     * returned is array.
     *
     * @covers Restriction::getShiftsApplications()
     */
    public function testShiftsRestrictionReturnedArray()
    {
        $this->assertTrue(is_array(Restriction::getShiftsApplications()));
    }

    /**
     * Verifies that the array with restrictions shifts contains
     * the next shifts: morning, afternoon.
     *
     * @param string $shift
     *
     * @dataProvider providerArrayWithShiftsOfApplication
     * @covers Restriction::getCalendarApplication()
     */
    public function testShiftsRestrictionContainsShift($shift)
    {
        $this->assertArrayHasKey($shift, Restriction::getShiftsApplications());
    }

    /**
     * Verifies that Car can't circulate.
     */
    public function testTheVehicleCanCirculateMethodShouldReturnFalse()
    {
        // Vehicle can't circulate between 07:00 - 09:30 and 16:00 - 19:30.
        $this->assertNotTrue(
            $this->Restriction->vehicleCanCirculate('2017-08-28', '19:30')
        );
    }


    /**
     * Verifies that Car can circulate.
     */
    public function testTheVehicleCanCirculateMethodShouldReturnTrue()
    {
        // Vehicle can circulate between 00:00 - 06:59, 09:31 - 15:59 and 19:31 - 11:59.
        $this->assertTrue(
            $this->Restriction->vehicleCanCirculate('2017-08-28', '13:00')
        );
    }
}