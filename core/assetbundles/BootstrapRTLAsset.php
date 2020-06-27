<?php

namespace core\assetbundles;

class BootstrapRTLAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/bootstrap-rtl/dist';

    public $css = [
        'css/bootstrap-rtl.min.css'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset'
    ];
}
