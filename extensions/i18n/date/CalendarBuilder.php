<?php
namespace extensions\i18n\date;

class CalendarBuilder
{
    public static function build($applicationLanguage)
    {
        switch ($applicationLanguage) {
            case 'fa':
                return Calendar::jalali();
            case 'en':
                return Calendar::gregorian();
            case 'ar':
                return Calendar::islamic();
            default:
                throw new \Exception("Unknown Language Code");
        }
    }
}
