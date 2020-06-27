<?php

namespace core\assetbundles;

use yii\web\AssetBundle;

class ModalFormAsset extends AssetBundle
{
    public $sourcePath = '@core/assets';

    public $js = [
        'js/modalform.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
