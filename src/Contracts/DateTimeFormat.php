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
    public function setDate($date);

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
    public function setTime($time);

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
     * @param string $date
     * @return bool
     */
    public function isValidateDateFormat($date);

    /**
     * To Verify a time supply it's
     * in a format valid.
     *
     * @param string $time
     * @return bool
     */
    public function isValidateTimeFormat($time);
}