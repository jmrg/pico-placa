<?php

namespace PicoPlaca\Contracts;

/**
 * Interface VehicleIdentificated
 */
interface VehicleIdentificated
{
    /**
     * @return string
     */
    public function getPlaca();

    /**
     * @return string
     */
    public function getRegexPlaca();

    /**
     * @return bool
     */
    public function validatePlaca();
}