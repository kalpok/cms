<?php
namespace core\assetbundles;

use yii\web\AssetBundle;

class FontAwesomeRtlAsset extends AssetBundle
{
    public $sourcePath = '@core/assets';
    public $css = [
        'css/font-awesome-rtl.css',
    ];
    public $depends = [
        'core\assetbundles\FontAwesomeAsset',
    ];
}
