<?php

namespace PicoPlaca\Test\Vehicle;

use PHPUnit\Framework\TestCase;
use PicoPlaca\Vehicle\Car;

/**
 * Class TestCar
 *
 * @package PicoPlaca\Test
 */
class TestCar extends TestCase
{
    /**
     * New Car instance.
     *
     * @var Car
     */
    protected $Car;

    protected function setUp()
    {
        $this->Car = new Car();
    }

    /**
     * Generate a number plate with this
     * format: [a-z]{3}-[0-9]{3,4}
     * Example: GSD-3691
     *
     * @return string
     */
    public function providerPlateRandom()
    {
            // Parts of the plate.
            $string = '';
            $number = rand(100, 9999);

            // Generate characters random.
            for ($i = 0; $i < 3; $i++) {
                $string .= chr(rand(65,90));
            }

            return $string.'-'.$number;
    }

    /**
     * Provider array with a license plate number.
     *
     * @return array
     */
    public function providerArrayWithLicensePlateNumber()
    {
        return [[$this->providerPlateRandom()]];
    }

    /**
     * Validate that the value assign at
     * the attribute plate is correct.
     *
     * @param string $licensePlateNumber
     *
     * @dataProvider providerArrayWithLicensePlateNumber
     * @covers Car::setPlate()
     */
    public function test($licensePlateNumber)
    {
        $this->Car->setPlate($licensePlateNumber);

        $this->assertAttributeSame($licensePlateNumber, 'plate', $this->Car);
    }

    /**
     * Verify that the license plate number
     * is null when the Car instance is
     * create.
     *
     * @covers Car::getPlate()
     */
    public function testPlateIsInitiallyEmpty()
    {
        $this->assertEmpty($this->Car->getPlate());
    }

    /**
     * Validate that the RegExp returned form Car
     * is a RegExp validate.
     *
     * @covers Car::getRegexpPlate()
     */
    public function testCarHasRegExpValidate()
    {
        // To validate a RegExp returned it again null.
        // If preg_match() return some thing different to false is a RegExp valid.
        $this->assertTrue(preg_match($this->Car->getRegexpPlate(), null) !== false);
    }

    /**
     * Validate that a RegExp supply form Car class satisfy
     * the string format.
     *
     * @param string $licensePlateNumber
     *
     * @dataProvider providerArrayWithLicensePlateNumber
     * @covers Car::validateLicensePlateNumber()
     */
    public function testValidateThatLicensePlateNumberSupplyIsCorrect($licensePlateNumber)
    {
        // The Car class always receives a license plate number valid.
        $this->Car->setPlate($licensePlateNumber);

        $this->assertTrue($this->Car->validateLicensePlateNumber());
    }
}