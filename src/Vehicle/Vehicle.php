<?php

namespace PicoPlaca\Vehicle;

use PicoPlaca\Contracts\VehicleIdentificated;

/**
 * Class Vehicle
 * @package PicoPlaca\Vehicle
 */
abstract class Vehicle implements VehicleIdentificated
{
    /**
     * @var string
     */
    private $placa = '';

    /**
     * @var string
     */
    private $regexPlaca = '/^([a-z]{3,4})-([0-9]{3,4})/i';

    /**
     * @return string
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param string $placa
     */
    public function setPlaca($placa = '')
    {
        $this->placa = $placa;
    }

    /**
     * @return string
     */
    public function getRegexPlaca()
    {
        return $this->regexPlaca;
    }

    /**
     * @param string $regex
     */
    public function setRegexPlaca($regex = null)
    {
        $this->regexPlaca = $regex;
    }
}