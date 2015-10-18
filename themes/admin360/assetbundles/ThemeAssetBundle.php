<?php
namespace themes\admin360\assetbundles;

use yii\web\AssetBundle;

class ThemeAssetBundle extends AssetBundle
{
    public $sourcePath = '@themes/admin360/assets';
    public $css = [
        'css/custom.css',
    ];
    public $js = [
        'js/app.js',
    ];
    public $depends = [
        'themes\admin360\assetbundles\Admin360Asset',
    ];
}
