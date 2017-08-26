<?php

namespace PicoPlaca\Restriction;

use PicoPlaca\Contracts\DateTimeFormat;

/**
 * Class Restriction
 *
 * @package PicoPlaca\Restriction
 */
class Restriction implements
    DateTimeFormat
{
    /**
     * RegExp default for validate a date.
     * Format: YYYY-MM-DD
     *
     * @var string
     */
    private $regexpDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

    /**
     * RegExp default for validate a Time.
     * Format: YYYY-MM-DD
     *
     * @var string
     */
    private $regexpTime = '/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';

    /**
     * Date to validate.
     *
     * @var string
     */
    private $date = '';

    /**
     * Time to validate.
     *
     * @var string
     */
    private $time = '';

    /**
     * Assign a value for the attribute
     * date.
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date = '')
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Return the date.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Assign a value for the attribute
     * time.
     *
     * @param string $time
     * @return $this
     */
    public function setTime($time = '')
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Return the time.
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Assign a value for the attribute
     * regexpDate.
     *
     * @param string $regexp
     * @return $this
     */
    public function setRegExpDate($regexp = '')
    {
        $this->regexpDate = $regexp;

        return $this;
    }

    /**
     * Return the RegExp for validate the
     * date.

     * @return string
     */
    public function getRegExpDate()
    {
        return $this->regexpDate;
    }


    /**
     * Assign a value for the attribute
     * regexpTime.
     *
     * @param string $regexp
     * @return $this
     */
    public function setRegExpTime($regexp = '')
    {
        $this->regexpTime = $regexp;

        return $this;
    }

    /**
     * Return the RegExp for validate the
     * time.

     * @return string
     */
    public function getRegExpTime()
    {
        return $this->regexpTime;
    }

    /**
     * To Verify a date supply it's
     * in a format valid.
     *
     * @return bool
     */
    public function isValidateDateFormat()
    {
        return (bool)preg_match($this->getRegExpDate(), $this->getDate());
    }

    /**
     * To Verify a time supply it's
     * in a format valid.
     *
     * @return bool
     */
    public function isValidateTimeFormat()
    {
        return (bool)preg_match($this->getRegExpTime(), $this->getTime());
    }
}