<?php
namespace extensions\i18n;

use yii\helpers\FormatConverter;
use extensions\i18n\date\Calendar;
use extensions\i18n\date\DateTime;
use extensions\i18n\language\LanguageBuilder;

class Formatter extends \yii\i18n\Formatter
{
    protected $_calendar;
    protected $dateTime;
    protected $i18n;

    private $intlLoaded = false;

    public function __construct(Calendar $calendar, DateTime $dateTime, I18N $i18n, $config = [])
    {
        $this->_calendar = $calendar;
        $this->dateTime = $dateTime;
        $this->i18n = $i18n;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        $this->intlLoaded = extension_loaded('intl');
        if ($this->intlLoaded && $this->_calendar->code == 'jalali') {
            $this->locale = 'fa_IR@calendar=persian';
            $this->calendar = \IntlDateFormatter::TRADITIONAL;
        }
    }

    public function asLanguage($value)
    {
        if ($value == null)
            return $this->nullDisplay;

        return LanguageBuilder::build($value)->title;
    }

    public function asFarsiNumber($value)
    {
        if ($value === null)
            return $this->nullDisplay;

        return $this->i18n->translateNumber($value);
    }

    public function asDate($value, $format = null)
    {
        if ($this->intlLoaded || $this->_calendar->code == 'gregorian') {
            return parent::asDate($value, $format);
        }
        if ($format === null) {
            $format = $this->dateFormat;
        }
        return $this->formatDateTimeValue($value, $format, 'date');
    }

    public function asDatetime($value, $format = null)
    {
        if ($this->intlLoaded || $this->_calendar->code == 'gregorian') {
            return parent::asDatetime($value, $format);
        }
        if ($format === null) {
            $format = $this->datetimeFormat;
        }
        return $this->formatDateTimeValue($value, $format, 'datetime');
    }

    private function formatDateTimeValue($value, $format, $type)
    {
        $timeZone = $this->timeZone;
        // avoid time zone conversion for date-only values
        if ($type === 'date') {
            list($timestamp, $hasTimeInfo) = $this->normalizeDatetimeValue($value, true);
            if (!$hasTimeInfo) {
                $timeZone = $this->defaultTimeZone;
            }
        } else {
            $timestamp = $this->normalizeDatetimeValue($value);
        }
        if ($timestamp === null) {
            return $this->nullDisplay;
        }
        if (strncmp($format, 'php:', 4) === 0) {
            $format = substr($format, 4);
        } else {
            $format = FormatConverter::convertDateIcuToPhp($format, $type, $this->locale);
        }
        if ($timeZone != null) {
            if ($timestamp instanceof \DateTimeImmutable) {
                $timestamp = $timestamp->setTimezone(new \DateTimeZone($timeZone));
            } else {
                $timestamp->setTimezone(new \DateTimeZone($timeZone));
            }
        }
        return $this->dateTime->date($format, $timestamp->getTimestamp());
    }
}
