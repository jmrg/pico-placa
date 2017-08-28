<?php

namespace PicoPlaca\Restriction;

use DateTime;
use PicoPlaca\Contracts\DateTimeFormat;
use PicoPlaca\Contracts\RestrictionCalendar;
use PicoPlaca\Contracts\VehicleIdentification;
use PicoPlaca\Exceptions\RestrictionException;

/**
 * Class Restriction
 *
 * @package PicoPlaca\Restriction
 */
class Restriction implements
    DateTimeFormat, RestrictionCalendar
{
    /**
     * @var VehicleIdentification
     */
    private $Vehicle;

    /**
     * RegExp default for validate a date.
     * Format: YYYY-MM-DD
     *
     * @var string
     */
    private $regexpDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

    /**
     * RegExp default for validate a Time.
     * Format: HH:MM
     *
     * @var string
     */
    private $regexpTime = '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';

    private static $structureFormat = [
        'date' => 'YYYY-MM-DD',
        'time' => 'HH:MM',
    ];

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
     * Days applications.
     *
     * @var array
     */
    private static $restrictionsDays = [
        'Mon' => [1, 2],
        'Tue' => [3, 4],
        'Wed' => [5, 6],
        'Thu' => [7, 8],
        'Fri' => [9, 0],
    ];

    /**
     * Restriction shifts.
     *
     * @var array
     */
    private static $restrictionsShifts = [
        'morning' => ['from' => '07:00', 'to' => '09:30'],
        'afternoon' => ['from' => '16:00', 'to' => '19:30'],
    ];

    /**
     * Restriction constructor.
     *
     * @param VehicleIdentification $vehicle
     */
    public function __construct(VehicleIdentification $vehicle)
    {
        $this->Vehicle = $vehicle;
    }

    /**
     * Assign a value for the attribute
     * date.
     *
     * @param string $date
     * @return Restriction
     */
    public function setDate($date)
    {
        $this->validateArgument($date, 'date');

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
     * @return Restriction
     */
    public function setTime($time)
    {
        $this->validateArgument($time, 'time');

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
     * @return Restriction
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
     * @return Restriction
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
     * Verifies a date supply it's
     * in a format valid.
     *
     * @param string $date
     * @return bool
     */
    public function isValidateDateFormat($date)
    {
        return (bool)preg_match($this->getRegExpDate(), $date);
    }

    /**
     * Verifies a time supply it's
     * in a format valid.
     *
     * @param string $time
     * @return bool
     */
    public function isValidateTimeFormat($time)
    {
        return (bool)preg_match($this->getRegExpTime(), $time);
    }

    /**
     * Return array with the days of
     * application of the regulations.
     *
     * @return array
     */
    public static function getCalendarApplication()
    {
        return static::$restrictionsDays;
    }

    /**
     * Return array with the shifts of
     * applications regulations on
     * the day.
     *
     * @return array
     */
    public static function getShiftsApplications()
    {
        return static::$restrictionsShifts;
    }

    /**
     * Verifies through of the calendar and shifts
     * applications that can circulate.
     *
     * @param string $date
     * @param string $time
     *
     * @return bool
     */
    public function vehicleCanCirculate($date, $time)
    {
        return $this
            ->setDateTime($date, $time)
            ->canCirculate();
    }

    /**
     * Verifies that the date and the time
     * don't empty.
     *
     * @param string $val
     * @param string $argName
     *
     * @return Restriction
     *
     * @throws RestrictionException
     */
    protected function validateArgument($val, $argName)
    {
        $this->isArgumentEmpty($val, $argName)
            ->argumentHasFormatValid($val, $argName);

        return $this;
    }

    /**
     * Verifies that val satisfy format required.
     *
     * @param $val
     * @param $argName
     *
     * @return Restriction
     *
     * @throws RestrictionException
     */
    protected function argumentHasFormatValid($val, $argName)
    {
        $format = $this->getFormatValid($argName);

        $method = "isValidate{$argName}Format";

        if (!$this->$method($val)) {
            throw new RestrictionException(
                "The arguments {$argName} not have format valid. Format valid: '{$format}'."
            );
        }

        return $this;
    }

    /**
     * Verifies that argument don't empty.
     *
     * @param string $val
     * @param string $argName
     *
     * @return Restriction
     *
     * @throws RestrictionException
     */
    protected function isArgumentEmpty($val, $argName)
    {
        if (empty($val)) {
            throw new RestrictionException("The arguments ${$argName} is required.");
        }

        return $this;
    }

    /**
     * Return a string with format depending the
     * argument supplied.
     *
     * @param $argName
     * @return string
     */
    protected function getFormatValid($argName)
    {
        $formats = static::$structureFormat;

        return array_key_exists($argName, $formats) ?
            $formats[$argName] : '';
    }

    /**
     * Setting the parameters for date and time.
     *
     * @param string $date
     * @param string $time
     *
     * @return Restriction
     */
    protected function setDateTime($date, $time)
    {
        $this->setDate($date)
            ->setTime($time);

        return $this;
    }

    /**
     * Verifies that a vehicle can do circulate.
     *
     * @return bool
     */
    protected function canCirculate()
    {
        if ($this->hasRestrictionForCalendar()) {
            return $this->toVerifyCirculateForTime();
        }

        return true;
    }

    /**
     * Return array with the digits restricted
     * to circulate in current date.
     *
     * @return array
     */
    protected function getRestrictedDigits()
    {
        $digits = [];

        $day = $this->getCurrentTextDay();

        // If this day has restrictions, the gets.
        if (array_key_exists($day, static::getCalendarApplication())) {
            $digits = static::getCalendarApplication()[$day];
        }

        return $digits;
    }

    /**
     * Return the string with day current.
     *
     * @return string
     */
    private function getCurrentTextDay()
    {
        $date = new DateTime($this->getDate());

        return $date->format('D');
    }

    /**
     * Verifies that the last digit of
     * the license plate number can be
     * circulate on the current day.
     *
     * @return bool
     */
    private function hasRestrictionForCalendar()
    {
        $restrictedDigits = $this->getRestrictedDigits();

        $lastDigitPlate = $this->Vehicle->getLastDigitPlate();

        return in_array($lastDigitPlate, $restrictedDigits);
    }

    /**
     * Verifies vehicle can circulate in
     * the shifts.
     *
     * @return bool
     */
    private function toVerifyCirculateForTime()
    {
        $time = strtotime($this->getTime());
        $restrictionsShifts = static::getShiftsApplications();

        $canCirculateMorning = $time < strtotime($restrictionsShifts['morning']['from'])
            || $time > strtotime($restrictionsShifts['morning']['to']);

        $canCirculateAfternoon = $time < strtotime($restrictionsShifts['afternoon']['from'])
            || $time > strtotime($restrictionsShifts['afternoon']['to']);

        return $canCirculateMorning && $canCirculateAfternoon;
    }
}