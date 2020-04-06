<?php

namespace extensions\i18n\widgets\jalaliDateTimePicker;

use yii\helpers\Json;
use yii\helpers\Html;
use extensions\i18n\widgets\jalaliDateTimePicker\assetBundles\JalaliDateTimePickerAsset;

/**
 * JalaliDateTimePicker is widget for working with date and time in persian or gregorian calendar.
 *
 * This widget is yii wrapper for babakhani/pwt.datepicker javascript jalali calendar capable datepicker widget.
 *
 * This widget can use in form or ActiveForm with model, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'date')->widget('JalaliDateTimePicker', [
 *     // configure additional widget properties here
 * ]) ?>
 * ```
 *
 * For more details and usage information on this widget, see http://babakhani.github.io/PersianWebToolkit/doc/datepicker
 *
 * @author Amirreza Yeganegi <amirreza.developer@gmail.com>
 */

class JalaliDateTimePicker extends \yii\widgets\InputWidget
{
    /**
     * @var array the picker configuration. for more details seehttp://babakhani.github.io/PersianWebToolkit/doc/datepicker/options
     */
    public $pickerOptions = [];
    /**
     * @var int timestamp representation for datetime. if you use this widget without model you must set this value according to 'D M d Y H:i:s O' format.
     */
    private $timestampValue;

    public function init()
    {
        if (!isset($this->pickerOptions['format'])) {
            $this->pickerOptions['format'] = 'dddd, DD MMMM YYYY';
        }
        if (!isset($this->pickerOptions['autoClose'])) {
            $this->pickerOptions['autoClose'] = true;
        }
        if (!isset($this->pickerOptions['altFormat'])) {
            $this->pickerOptions['altFormat'] = 'X';
        }
        $this->setInitialValue();
        parent::init();
    }

    public function setInitialValue()
    {
        if (isset($this->value)) {
            $this->timestampValue = $this->value;
        } elseif ($this->hasModel()) {
            $modelValue = Html::getAttributeValue($this->model, $this->attribute);
            $this->timestampValue = $modelValue ? date('D M d Y H:i:s O', $modelValue) : null;
        }
    }

    public function run()
    {
        $fieldId = $this->options['id'];
        $altFieldId = $fieldId . '-alt';

        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $this->attribute, ['id' => $fieldId]);
            $this->options = array_merge($this->options, ['id' => $altFieldId]);
            echo Html::textInput($this->attribute, $this->timestampValue, $this->options);
        } else {
            echo Html::hiddenInput($this->name, null, ['id' => $fieldId]);
            $this->options = array_merge($this->options, ['id' => $altFieldId]);
            echo Html::textInput($this->name, $this->timestampValue, $this->options);
        }
        $this->registerClientScript($fieldId, $altFieldId);
    }

    public function registerClientScript($fieldId, $altFieldId)
    {
        $view = $this->getView();
        JalaliDateTimePickerAsset::register($view);
        $this->pickerOptions['altField'] = "#$fieldId";
        $options = !empty($this->pickerOptions) ? Json::htmlEncode($this->pickerOptions) : '';
        $view->registerJs(<<<JS
            $('#$altFieldId').pDatepicker({$options});
JS
);
    }
}
