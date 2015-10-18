<?php
namespace core\widgets\editor;

use Yii;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;

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
}
