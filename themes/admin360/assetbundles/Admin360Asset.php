<?php
namespace themes\admin360\assetbundles;

use yii\web\AssetBundle;

class Admin360Asset extends AssetBundle
{
    public $sourcePath = '@themes/admin360/bower_components/admin360/dist';
    public $css = [
        'css/sb-admin-2-rtl.css',
        'css/admin360.css',
    ];
    public $depends = [
        'themes\admin360\assetbundles\SbAdminAsset',
        'core\assetbundles\BootstrapRTLAsset',
        'core\assetbundles\FontAwesomeRtlAsset',
    ];
}
