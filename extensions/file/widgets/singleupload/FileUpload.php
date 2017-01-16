<?php
namespace extensions\file\widgets\singleupload;

use Yii;
use yii\web\View;
use yii\helpers\Url;
use extensions\file\models\File;
use yii\base\InvalidParamException;
use extensions\file\behaviors\FileBehavior;

class FileUpload extends \yii\base\Widget
{
	public $model;
    public $group;
    public $label;
    public $folderName;

    public function init()
    {
        parent::init();
        $this->checkIfFileBehaviorIsAttached();
        $this->checkIfGivenGroupExists();
        if (!isset($this->folderName)) {
            $this->setFolderName();
        }
        SingleUploadAsset::register($this->getView());
    }

    private function setFolderName()
    {
        if (isset(Yii::$app->controller->module)) {
            $this->folderName = Yii::$app->controller->module->id;
        } else {
            throw new InvalidParamException("`\$folderName` property can't be empty.");
        }
    }

    private function checkIfFileBehaviorIsAttached()
    {
        $behaviors = $this->model->behaviors;
        foreach ($behaviors as $behavior) {
            if ($behavior::className() === FileBehavior::className()){
                return true;
            }
        }
        $model = $this->model;
        throw new \Exception("To use FileUpload widgets, FileBehavior should be attached to the {$model::className()}.");
    }

    private function checkIfGivenGroupExists()
    {
        $groupNames = array_keys($this->model->getFileGroups());
        if (!in_array($this->group, $groupNames)) {
            $model = $this->model;
            throw new \Exception("Given group name `{$this->group}` must be defined in FileBehavior attached to {$model::className()}.");
        }
    }

    protected function createFileObject()
    {
        $file = new File;
        $model = $this->model;
        $file->group = $this->group;
        $file->folderName = $this->folderName;
        $file->addErrors($model->getFileErrors($this->group));
        return $file;
    }

    public function run()
    {
        throw new \Exception(
            "You should not call this widget directly. call one of its children."
        );
    }
}
