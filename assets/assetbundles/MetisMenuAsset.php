<?php
namespace core\assetbundles;

use yii\web\AssetBundle;

class MetisMenuAsset extends AssetBundle
{
    public $sourcePath = '@bower/metisMenu/dist';
    public $css = [
        'metisMenu.min.css',
    ];
    public $js = [
    	'metisMenu.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
