<?php
namespace extensions\file\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use extensions\file\models\File;
use yii\base\InvalidParamException;

class FileBehavior extends Behavior
{
    const TYPE_IMAGE = true;
    const TYPE_FILE = false;

    public $groups = [];
    private $fileErrors = [];

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'validateFiles',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'validateFiles',
            ActiveRecord::EVENT_AFTER_INSERT => 'uploadFiles',
            ActiveRecord::EVENT_AFTER_UPDATE => 'uploadFiles',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleteFiles',
        ];
    }

    public function validateFiles($event)
    {
        $isValid = true;
        $post = Yii::$app->request->post('File', []);
        foreach ($post as $key => $params) {
            $uploadedFile = UploadedFile::getInstanceByName("File[{$key}][resource]");
            if (null != $uploadedFile & isset($this->groups[$params['group']])) {
                $file = new File;
                $file->group = $params['group'];
                $file->resource = $uploadedFile;
                if (isset($this->groups[$file->group]['rules'])) {
                    $file->addValidationRules($this->groups[$file->group]['rules']);
                }
                if (!$file->validate()) {
                    $this->fileErrors[$file->group] = $file->getErrors();
                    $isValid = false;
                }
            }
        }
        $event->isValid = $isValid;
    }

    public function getFileErrors($group)
    {
        return isset($this->fileErrors[$group]) ? $this->fileErrors[$group] : [];
    }

    public function uploadFiles()
    {
        $post = Yii::$app->request->post('File', []);
        foreach ($post as $key => $params) {
            $uploadedFile = UploadedFile::getInstanceByName("File[{$key}][resource]");
            if (null != $uploadedFile & isset($this->groups[$params['group']])) {
                $file = new File;
                $file->load(['File' => $params]);
                $file->resource = $uploadedFile;
                $file->isImage = $this->groups[$file->group]['type'];
                $owner = $this->owner;
                $file->modelId = $owner->id;
                $file->modelClassName = $owner::className();
                $file->save();
            }
        }
    }

    public function deleteFiles()
    {
        $files = File::getAllFilesOfModel($this->owner);
        foreach ($files as $file) {
            $file->delete();
        }
    }

    public function getFileGroups()
    {
        return $this->groups;
    }

    public function getFiles($group = null)
    {
        if (null == $group) {
            throw new InvalidParamException("missing one parameter for FileBehavior method `getFile(\$group)`");
        }
        return File::getByModelAndGroup($this->owner, $group);
    }

    public function getFile($group = null)
    {
        $files = $this->getFiles($group);
        return (!empty($files)) ? $files[0] : null;
    }

    public function hasFile($group)
    {
        $file = $this->getFile($group);
        return isset($file);
    }
}
