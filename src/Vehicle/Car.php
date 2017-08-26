<?php

namespace PicoPlaca\Vehicle;

/**
 * Class Car
 * @package PicoPlaca\Vehicle
 */
class Car extends Vehicle
{
    /**
     * @return bool
     */
    public function validatePlaca()
    {
        return (bool)preg_match($this->getRegexPlaca(), $this->getPlaca());
    }
}