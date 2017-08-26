<?php

namespace PicoPlaca\Contracts;

/**
 * Interface DateTimeFormat
 *
 * @package PicoPlaca\Contracts
 */
interface DateTimeFormat
{
    /**
     * Assign a value for the attribute
     * date.
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date = '');

    /**
     * Return the date.
     *
     * @return string
     */
    public function getDate();

    /**
     * Assign a value for the attribute
     * time.
     *
     * @param string $time
     * @return $this
     */
    public function setTime($time = '');

    /**
     * Return the time.
     *
     * @return string
     */
    public function getTime();

    /**
     * To Verify a date supply it's
     * in a format valid.
     *
     * @return bool
     */
    public function isValidateDateFormat();

    /**
     * To Verify a time supply it's
     * in a format valid.
     *
     * @return bool
     */
    public function isValidateTimeFormat();
}