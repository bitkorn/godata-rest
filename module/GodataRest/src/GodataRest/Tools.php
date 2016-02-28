<?php
namespace GodataRest;
/**
 * Description of Tools
 *
 * @author allapow
 */
class Tools
{
    /**
     * Filter an AngularJS date (2016-02-22T23:00:00.000Z) to an ISO8601 date.
     * For PHP DateTime constants for ISO date filtering look at:
     * http://php.net/manual/en/class.datetime.php#datetime.constants.types
     * @param string $angularDate
     * @return string
     */
    public static function angularDateToISO8601($angularDate) {
        return str_replace(['Z', '.'], ['0', '+'], $angularDate);
    }
}
