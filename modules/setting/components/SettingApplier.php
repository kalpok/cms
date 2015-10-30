<?php
namespace modules\setting\components;

use Yii;
use yii\base\BootstrapInterface;

class SettingApplier implements BootstrapInterface
{
    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function bootstrap($app)
    {
        $this->setCache();
        $this->setTimeZone();
    }

    private function setCache()
    {
        $enabled = $this->settings->get('website.cache');
        if (!$enabled) {
            Yii::$app->setComponents([
                'cache' => [
                    'class' => 'yii\caching\DummyCache'
                ]
            ]);
        }
    }

    private function setTimeZone()
    {
        Yii::$app->timeZone = $this->settings->get('website.timezone');
    }
}
