<?php
namespace core\assetbundles;

use yii\web\AssetBundle;

class JasnyBootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/jasny-bootstrap/dist';
    public $css = [
        'css/jasny-bootstrap.min.css',
    ];
    public $js = [
        'js/jasny-bootstrap.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
