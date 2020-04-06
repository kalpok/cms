<?php

namespace core\widgets\editor;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use core\widgets\editor\assetbundles\EditorAsset;

class Editor extends CKEditor
{
    public $preset = 'simple';
    public $enableUploader = true;

    public function initOptions()
    {
        $this->setPreset();
        $this->setLanguage();
        $this->setFileUploader();
        $this->setImageUploader();
        $this->addCustomPlugins();
    }

    private function setFileUploader()
    {
        if ($this->enableUploader && !isset($this->clientOptions['filebrowserUploadUrl'])) {
            $params = $this->getUploadParams();
            $params['type'] = 'file';
            $this->clientOptions['filebrowserUploadUrl'] =
                Yii::$app->urlManager->createUrl($params);
        }
    }

    private function setImageUploader()
    {
        if ($this->enableUploader && !isset($this->clientOptions['filebrowserImageUploadUrl'])) {
            $params = $this->getUploadParams();
            $params['type'] = 'image';
            $this->clientOptions['filebrowserImageUploadUrl'] =
                Yii::$app->urlManager->createUrl($params);
        }
    }

    public function getUploadParams()
    {
        return [
            'file/editor-upload',
            'module' => $this->getCallerModule(),
            'classname' => $this->model->className(),
            'modelid' => (!$this->model->isNewRecord) ? $this->model->id : null
        ];
    }

    private function getCallerModule()
    {
        if (isset(Yii::$app->controller->module)) {
            return Yii::$app->controller->module->id;
        } else {
            return 'unknown';
        }
    }

    private function setPreset()
    {
        switch ($this->preset) {
            case 'simple':
                $preset = __DIR__ . '/presets/' . $this->preset . '.php';
                break;
            case 'advanced':
                $preset = __DIR__ . '/presets/' . $this->preset . '.php';
                break;
            default:
                parent::initOptions();
        }
        if (isset($preset)) {
            $this->clientOptions = ArrayHelper::merge(require($preset), $this->clientOptions);
        }
    }

    private function setLanguage()
    {
        if (!isset($this->clientOptions['language'])) {
            $this->clientOptions['language'] = 'fa';
        }
    }

    private function addCustomPlugins()
    {
        if (!isset($this->clientOptions['extraPlugins'])) {
            $this->clientOptions['extraPlugins'] = 'justify,bidi';
        }
    }

    private function registerPluginsJs()
    {
        foreach (['justify', 'bidi'] as $plugin) {
            $this->getView()->registerJs(
                "CKEDITOR.plugins.addExternal(
                    '{$plugin}', '/admin/{$plugin}/plugin.js', ''
                );"
            );
        }
    }

    protected function registerPlugin()
    {
        $js = [];
        $view = $this->getView();
        EditorAsset::register($view);
        $id = $this->options['id'];
        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '{}';
        $js[] = "CKEDITOR.replace('$id', $options);";
        $js[] = "editor.registerOnChangeHandler('$id');";
        if (isset($this->clientOptions['filebrowserUploadUrl'])) {
            $js[] = "editor.registerCsrfFileUploadHandler();";
        }
        if (isset($this->clientOptions['filebrowserImageUploadUrl'])) {
            $js[] = "editor.registerCsrfImageUploadHandler();";
        }
        $view->registerJs(implode("\n", $js));
    }
}
