<?php
namespace extensions\gallery\assetbundles;

use yii\web\AssetBundle;

class GalleryCrudAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/../assets/';
    public $js = [
        'main.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
