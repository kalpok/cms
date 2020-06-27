<?php

namespace core\assetbundles;

class FontAwesomeRtlAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@core/assets';

    public $css = [
        'css/font-awesome-rtl.css'
    ];

    public $depends = [
        'core\assetbundles\FontAwesomeAsset'
    ];
}
