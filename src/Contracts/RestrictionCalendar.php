<?php

namespace PicoPlaca\Contracts;

/**
 * Class RestrictionCalendar
 *
 * @package PicoPlaca\Contracts
 */
interface RestrictionCalendar
{
    /**
     * Return array with the days of
     * application of the regulations.
     *
     * @return array
     */
    public static function getCalendarApplication();

    /**
     * Return array with the shifts of
     * applications regulations on
     * the day.
     *
     * @return array
     */
    public static function getShiftsApplications();

    /**
     * Verify through the calendar and shifted
     * applications which one can circulate.
     *
     * @param string $date
     * @param string $time
     *
     * @return bool
     */
    public function vehicleCanCirculate($date, $time);
}