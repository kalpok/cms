<?php
namespace extensions\i18n\date;

class Calendar
{
    public $code;

    private function __construct($code) {
        $this->code = $code;
    }

    public static function jalali()
    {
        return new self('jalali');
    }

    public static function islamic()
    {
        return new self('islamic');
    }

    public static function gregorian()
    {
        return new self('gregorian');
    }
}
