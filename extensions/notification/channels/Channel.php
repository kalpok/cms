<?php

namespace extensions\notification\channels;

use extensions\notification\Notification;

abstract class Channel extends \yii\base\BaseObject
{
    public $id;

    public function __construct($id, $config = [])
    {
        $this->id = $id;
        parent::__construct($config);
    }

    abstract public function send(Notification $notification);
}
