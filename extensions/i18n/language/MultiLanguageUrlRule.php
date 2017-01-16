<?php
namespace extensions\i18n\language;

class MultiLanguageUrlRule extends \yii\web\UrlRule
{
    public function init()
    {
        $this->addLanguagePrefixToPattern();
        parent::init();
    }

    private function addLanguagePrefixToPattern()
    {
        $prefix = $this->getLanguagePrefix();
        $this->pattern = $prefix . '/' . $this->pattern;
    }

    private function getLanguagePrefix()
    {
        return "<language:" . implode('|', \Yii::$app->i18n->languages) . '>';
    }
}
