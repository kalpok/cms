<?php
namespace core\grid;

use yii\helpers\Html;
use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;

class LanguageColumn extends DataColumn
{
    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'language';
        }
        $this->format = 'language';
        $this->options = ['style' => 'width:10%;'];
        $this->visible = \Yii::$app->i18n->isMultiLanguage();
        $this->filter = ArrayHelper::map(
            \Yii::$app->i18n->availableLanguages(), 'code', 'title'
        );
    }
}
