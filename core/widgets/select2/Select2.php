<?php

namespace core\widgets\select2;

class Select2 extends \kartik\select2\Select2
{
    public $showToggle = false;

    public function init()
    {
        if (!isset($this->options['dir'])) {
            $this->options['dir'] = 'rtl';
        }
        $this->showToggleAll = $this->showToggle;

        parent::init();
    }
}
