<?php
namespace extensions\mailer;

use Yii;

class Mailer extends \yii\swiftmailer\Mailer
{
    public $plugins;
    public $messageClass = 'extensions\mailer\Message';
    public $htmlLayout = '@extensions/mailer/layouts/main';

    public function init()
    {
        parent::init();
        $this->setTransport(null);
    }

    public function setTransport($transport)
    {
        $protocol = Yii::$app->setting->get('email.protocol');
        if ($protocol != 'smtp') {
            return;
        }

        $configs = $this->setSmtpTransportConfigs();
        if (!empty($this->plugins)) {
            $this->addPluginConfigs($configs);
        }

        parent::setTransport($configs);
    }

    private function setSmtpTransportConfigs()
    {
        $settings = Yii::$app->setting;
        return [
            'class' => 'Swift_SmtpTransport',
            'host' => $settings->get('email.smtpServer'),
            'port' => $settings->get('email.smtpPort'),
            'username' => $settings->get('email.smtpUsername'),
            'password' => $settings->get('email.smtpPassword'),
            // 'encryption' => 'tls',
        ];
    }

    private function addPluginConfigs(&$configs)
    {
        $configs['plugins'] = $this->plugins;
        $this->plugins = null;
    }
}
