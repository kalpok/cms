<?php

namespace core\widgets\editor\assetbundles;

use yii\web\AssetBundle;

class EditorAsset extends AssetBundle
{
    public $sourcePath = '@core/widgets/editor/assets/';

    public $depends = [
        'dosamigos\ckeditor\CKEditorAsset'
    ];

    public $js = [
        'js/editor.js'
    ];
}
