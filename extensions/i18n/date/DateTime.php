<?php
namespace extensions\i18n\date;

use yii\base\InvalidParamException;
use extensions\i18n\date\lib\JDateTime;

class DateTime
{
    protected $calendar;
    protected $jDate;

    public function __construct(Calendar $calendar, JDateTime $jDate)
    {
        $this->calendar = $calendar;
        $this->jDate = $jDate;
    }

    public function date($format, $stamp = false)
    {
        switch ($this->calendar->code) {
            case 'jalali':
                return $this->jDate->date($format, $stamp);
            case 'islamic':
                throw new \Exception("Islamic calendar is not supported yet");
            default:
                return date($format, $stamp);
        }
    }

    public function mktime($hour, $minute, $second, $month, $day, $year)
    {
        switch ($this->calendar->code) {
            case 'jalali':
                return $this->jDate->mktime($hour, $minute, $second, $month, $day, $year);
            case 'islamic':
                throw new \Exception("Islamic calendar is not supported yet");
            default:
                return mktime($hour, $minute, $second, $month, $day, $year);
        }
    }

    public function strtotime($strdate, $format)
    {
        switch ($this->calendar->code) {
            case 'jalali':
                return $this->jalaliStrtotime($strdate, $format);
            case 'islamic':
                return "";
            default:
                return strtotime($strdate);
        }
    }

    public function validate($date, $format)
    {
        $pd = date_parse_from_format($format, $date);
        return !($pd['error_count'] > 0
            or $pd['year'] > 1500
            or $pd['year'] < 1000
            or $pd['month'] > 12
            or $pd['month'] < 1
            or $pd['day'] > 31
            or $pd['day'] < 1);
    }

    public function getMonthName($monthNumber)
    {
        return $this->date("F", $this->mktime(0, 0, 0, $monthNumber, 1, 2011));
    }

    private function jalaliStrtotime($strdate, $format)
    {
        if (!$this->validate($strdate, $format)) {
            throw new InvalidParamException(
                "Given date string: {$strdate}, is not in form of given format: {$format}", 1);
        }
        $pd = date_parse_from_format($format, $strdate);
        return $this->mktime(
            $pd['hour'],
            $pd['minute'],
            $pd['second'],
            $pd['month'],
            $pd['day'],
            $pd['year']
        );
    }
}
