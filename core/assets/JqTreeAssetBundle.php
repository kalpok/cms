<?php
namespace core\assets;

use yii\web\AssetBundle;

class JqTreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@core/assets/jqTree';

    public $css = ['jqtree.css'];

    public $js = ['tree.jquery.js'];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
