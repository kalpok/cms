<?php
namespace extensions\i18n\widgets;

use Yii;
use yii\bootstrap\Html;
use yii\widgets\InputWidget;
use yii\helpers\ArrayHelper;

class LanguageSelect extends InputWidget
{
    public function run()
    {
        if (Yii::$app->i18n->isMultiLanguage())
            $this->renderDropdown();
    }

    private function renderDropdown()
    {
        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->getItems(), $this->options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $this->getItems(), $this->options);
        }
    }

    private function getItems()
    {
        return ArrayHelper::map(Yii::$app->i18n->availableLanguages(), 'code', 'title');
    }
}
