<?php
namespace extensions\i18n;

use Yii;
use yii\base\BootstrapInterface;
use extensions\i18n\date\CalendarBuilder;
use extensions\i18n\language\LanguageBuilder;

class LanguageAndCalendarSetter implements BootstrapInterface
{
    public function bootstrap($app){
        self::setDependencies();
    }

    public static function set()
    {
        if (isset($_GET['language'])) {
            Yii::$app->language = $_GET['language'];
        }
        self::setDependencies();
    }

    private static function setDependencies()
    {
        Yii::$container->set('language', 'extensions\i18n\language\Language');
        Yii::$container->setSingleton('extensions\i18n\language\Language', function () {
            return LanguageBuilder::build(Yii::$app->language);
        });

        Yii::$container->set('calendar', 'extensions\i18n\date\Calendar');
        Yii::$container->setSingleton('extensions\i18n\date\Calendar', function () {
            return CalendarBuilder::build(Yii::$app->language);
        });
    }
}
