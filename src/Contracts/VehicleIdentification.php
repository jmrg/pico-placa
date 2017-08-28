<?php

namespace PicoPlaca\Contracts;

/**
 * Interface VehicleIdentification
 */
interface VehicleIdentification
{
    /**
     * Return the license plate number.
     *
     * @return string
     */
    public function getPlate();

    /**
     * Assign a value for the attribute
     * plate.
     *
     * @param string $plate
     * @return $this
     */
    public function setPlate($plate);

    /**
     * Return the RegExp for validate the
     * license plate number.

     * @return string
     */
    public function getRegexpPlate();

    /**
     * Assign a value for the attribute
     * regexpPlate.
     *
     * @param string $regexp
     * @return $this
     */
    public function setRegexpPlate($regexp);

    /**
     * Verifies thar license plate number meet
     * required format.
     *
     * @return bool
     */
    public function validateLicensePlateNumber();

    /**
     * Return the last digit of the
     * license number plate.
     *
     * @return string
     */
    public function getLastDigitPlate();
}