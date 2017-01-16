<?php
namespace extensions\mailer;

use Yii;

class Message extends \yii\swiftmailer\Message
{
    public function init()
    {
        parent::init();
        $this->setFromHeaderBasedOnSettings();
    }

    private function setFromHeaderBasedOnSettings()
    {
        $senderEmail = Yii::$app->setting->get('email.senderEmail');
        $senderName = Yii::$app->setting->get('email.senderName');

        if (empty($senderEmail))
            return;

        $sender = empty($senderName) ? $senderEmail : [$senderEmail => $senderName];
        $this->setFrom($sender);
    }
}
