<?php

namespace extensions\i18n\widgets\jalaliDateTimePicker\assetBundles;

use yii\web\AssetBundle;

class JalaliDateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@bower';

    public $js = [
        'persian-date/dist/persian-date.js',
        'persian-datepicker/dist/js/persian-datepicker.js',
    ];

    public $css = [
        'persian-datepicker/dist/css/persian-datepicker.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
