<?php

namespace PicoPlaca\Vehicle;

use PicoPlaca\Contracts\VehicleIdentification;

/**
 * Class Car
 *
 * @package PicoPlaca\Vehicle
 */
class Car implements VehicleIdentification
{
    /**
     * License plate number.
     *
     * @var string
     */
    private $plate = '';

    /**
     * RegExp default for validate a license
     * plate number.
     *
     * @var string
     */
    private $regexpPlate = '/^([a-z]{3,4})-([0-9]{3,4})/i';

    /**
     * Return the license plate number.
     *
     * @return string
     */
    public function getPlate()
    {
        return $this->plate;
    }

    /**
     * Assign a value for the attribute
     * plate.
     *
     * @param string $plate
     * @return Car
     */
    public function setPlate($plate)
    {
        $this->plate = $plate;

        return $this;
    }

    /**
     * Return the RegExp for validate the
     * license plate number.

     * @return string
     */
    public function getRegexpPlate()
    {
        return $this->regexpPlate;
    }

    /**
     * Assign a value for the attribute
     * regexpPlate.
     *
     * @param string $regexp
     * @return Car
     */
    public function setRegexpPlate($regexp)
    {
        $this->regexpPlate = $regexp;

        return $this;
    }

    /**
     * Verify thar license plate number meet
     * required format.
     *
     * @return bool
     */
    public function validateLicensePlateNumber()
    {
        return (bool)preg_match($this->getRegexpPlate(), $this->getPlate());
    }

    /**
     * Return the last digit of the
     * license number plate.
     *
     * @return string
     */
    public function getLastDigitPlate()
    {
        $charactersPlate = str_split($this->getPlate());

        return end($charactersPlate);
    }
}