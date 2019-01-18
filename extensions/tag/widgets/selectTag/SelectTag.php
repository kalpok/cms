<?php

namespace extensions\tag\widgets\selectTag;

use yii\helpers\Url;
use core\widgets\select2\Select2;

class SelectTag extends Select2
{
    public function init()
    {
        if (!isset($this->options['placeholder'])) {
            $this->options['placeholder'] = 'کلید‌ واژه‌ها را انتخاب کنید ...';
        }
        if (!isset($this->options['multiple'])) {
            $this->options['multiple'] = true;
        }
        if (!isset($this->pluginOptions['tags'])) {
            $this->pluginOptions['tags'] = true;
        }
        if (!isset($this->pluginOptions['allowClear'])) {
            $this->pluginOptions['allowClear'] = true;
        }
        if (!isset($this->pluginOptions['minimumInputLength'])) {
            $this->pluginOptions['minimumInputLength'] = 2;
        }
        if (!isset($this->pluginOptions['ajax'])) {
            $this->pluginOptions['ajax'] = [
                'url' => Url::to(['/tag/ajax-find-tags']),
                'dataType' => 'json',
                'delay' => 1000
            ];
        }
        parent::init();
    }
}
