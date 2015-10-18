<?php
namespace core\assetbundles;

use yii\web\AssetBundle;

class IEAssetBundle extends AssetBundle
{
    public $jsOptions = ['condition' => 'lte IE9', 'position' => \yii\web\View::POS_HEAD];
    public $js = [
        'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
        'https://oss.maxcdn.com/respond/1.4.2/respond.min.js'
    ];
}
