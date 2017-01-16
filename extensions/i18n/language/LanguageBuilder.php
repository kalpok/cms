<?php
namespace extensions\i18n\language;

class LanguageBuilder
{
    public static function build($code)
    {
        switch ($code) {
            case 'fa':
                return new Language('fa', 'فارسی', Language::DIRECTION_RTL);
            case 'en':
                return new Language('en', 'انگلیسی', Language::DIRECTION_LTR);
            case 'ar':
                return new Language('ar', 'عربی', Language::DIRECTION_RTL);
            default:
                throw new \Exception("Unknown Language Code: $code");
        }
    }
}
