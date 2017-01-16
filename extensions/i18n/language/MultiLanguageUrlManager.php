<?php
namespace extensions\i18n\language;

use Yii;

class MultiLanguageUrlManager extends \yii\web\UrlManager
{
    public $ruleConfig = ['class' => '\extensions\i18n\language\MultiLanguageUrlRule'];

    public function init()
    {
        $this->addHomePageRules();
        parent::init();
    }

    private function addHomePageRules()
    {
        $this->rules[''] = 'site/index';
    }

    public function createUrl($params)
    {
        $params = (array) $params;
        if (!isset($params['language'])) {
            $params['language'] = Yii::$app->language;
        }

        return parent::createUrl($params);
    }

    public function createAbsoluteUrl($params, $scheme = null)
    {
        $params = (array) $params;
        if (!isset($params['language'])) {
            $params['language'] = Yii::$app->language;
        }

        return parent::createAbsoluteUrl($params, $scheme);
    }
}
