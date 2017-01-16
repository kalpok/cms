<?php
namespace extensions\i18n\language;

class Language
{
    const DIRECTION_RTL = 'rtl';
    const DIRECTION_LTR = 'ltr';

    public $code;
    public $title;
    public $direction;

    public function __construct($code, $title, $direction) {
        $this->code = $code;
        $this->title = $title;
        $this->direction = $direction;
    }
}
