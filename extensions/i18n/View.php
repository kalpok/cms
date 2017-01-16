<?php
namespace extensions\i18n;

use extensions\i18n\language\Language;
use extensions\i18n\language\LanguageBuilder;

class View extends \yii\web\View
{
    public function isRTL()
    {
        return LanguageBuilder::build(\Yii::$app->language)->direction ==
            Language::DIRECTION_RTL;
    }
}
