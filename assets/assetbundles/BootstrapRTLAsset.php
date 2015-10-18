<?php
namespace core\assetbundles;

use yii\web\AssetBundle;

class BootstrapRTLAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-rtl/dist';
    public $css = [
        'css/bootstrap-rtl.min.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
