<?php

namespace extensions\i18n\date;

use extensions\i18n\date\lib\JDateTime;

class DateUtility
{
    public $monthNumber;
    public $yearNumber;
    public $dayNumberInWeek;
    public $dayNumberInMonth;

    private $jd;
    private $time;

    public function __construct($time)
    {
        $this->time = $time;
        $this->init();
    }

    public function init()
    {
        $this->jd = new JDateTime();
        $this->monthNumber = $this->convertNumberToEnglish(
            $this->jd->date('n', $this->time)
        );
        $this->yearNumber = $this->convertNumberToEnglish(
            $this->jd->date('Y', $this->time)
        );
        $this->dayNumberInWeek = $this->convertNumberToEnglish(
            $this->jd->date('N', $this->time)
        );
        $this->dayNumberInMonth = $this->convertNumberToEnglish(
            $this->jd->date('j', $this->time)
        );
    }

    public function convertNumberToEnglish($persianNumber)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = range(0, 9);
        return str_replace($persian, $english, $persianNumber);
    }

    public function getTimestampOfFirstDayOfMonth()
    {
        return $this->jd->mktime(0, 0, 0, $this->monthNumber, 1, $this->yearNumber);
    }

    public function getTimestampOfLastDayOfMonth()
    {
        if ($this->monthNumber < 7) {
            return $this->jd->mktime(23, 59, 59, $this->monthNumber, 31, $this->yearNumber);
        } else {
            return $this->jd->mktime(23, 59, 59, $this->monthNumber, 30, $this->yearNumber);
        }
    }

    public function getTimestampOfFirstDayOfYear()
    {
        return $this->jd->mktime(0, 0, 0, 1, 1, $this->yearNumber);
    }

    public function getTimestampOfLastDayOfYear()
    {
        if (date('L', $this->time) == 1) {
            return $this->jd->mktime(23, 59, 59, 12, 30, $this->yearNumber);
        }
        return $this->jd->mktime(23, 59, 59, 12, 29, $this->yearNumber);
    }

    public function getTimestampOfFirstDayOfWeek()
    {
        return $this->jd->mktime(
            0,
            0,
            0,
            $this->monthNumber,
            ($this->dayNumberInMonth - $this->dayNumberInWeek + 1),
            $this->yearNumber
        );
    }

    public function getTimestampOfLastDayOfWeek()
    {
        return $this->jd->mktime(
            23,
            59,
            59,
            $this->monthNumber,
            ($this->dayNumberInMonth + 7 - $this->dayNumberInWeek),
            $this->yearNumber
        );
    }

    public function getDaysInMonth()
    {
        if ($this->monthNumber < 7) {
            return 31;
        } elseif ($this->monthNumber < 12) {
            return 30;
        } elseif (date('L', $this->time) == 1) {
            return 30;
        } else {
            return 29;
        }
    }
}
