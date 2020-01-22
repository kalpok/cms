<?php
namespace extensions\file\models;

use Yii;
use yii\helpers\Url;
use core\helpers\Inflector;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;
use yii\validators\FileValidator;
use yii\base\InvalidParamException;

class File extends \yii\db\ActiveRecord
{
    public $resource;

    public static function tableName()
    {
        return '{{%file}}';
    }

    public function behaviors()
    {
        return [
            'core\behaviors\TimestampBehavior'
        ];
    }

    public function rules()
    {
        return [
            [['group', 'folderName'], 'safe']
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert) and isset($this->resource)) {
            $this->originalName = $this->resource->name;
            $this->extension = $this->resource->extension;
            $this->filename = $this->prepareFileName();
            $this->mimeType = $this->resource->type;
            $this->byteSize = $this->resource->size;
            $this->hash = hash_file('md5', $this->resource->tempName);
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        FileHelper::createDirectory($this->uploadFolder, 0755);
        $this->resource->saveAs($this->path);
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if (!file_exists($this->path)) {
                return true;
            }
            return is_writable($this->path);
        }
        return false;
    }

    public function afterDelete()
    {
        if (file_exists($this->path)) {
            unlink($this->path);
        }
    }

    public function addValidationRules($rules)
    {
        $validator = new FileValidator;
        $validator->attributes = ['resource'];
        $validator->minSize = isset($rules['minSize']) ? $rules['minSize']: null;
        $validator->maxSize = isset($rules['maxSize']) ? $rules['maxSize']: null;
        $validator->maxFiles = isset($rules['maxFiles']) ? $rules['maxFiles'] : 1;
        $validator->mimeTypes = isset($rules['mimeTypes']) ? $rules['mimeTypes']: [];
        $validator->extensions = isset($rules['extensions']) ? $rules['extensions']: [];
        $this->validators[] = $validator;
    }

    public function getPath()
    {
        return $this->uploadFolder . $this->filename;
    }

    public function getUploadFolder()
    {
        $directory = $this->isImage ? 'images' : 'files';
        return Yii::getAlias('@uploads') . '/' . $directory
            . '/' . $this->folderName
            . '/' . strtolower(StringHelper::basename($this->modelClassName))
            . '/' . date('Y', $this->createdAt)
            . '/' . date('m', $this->createdAt)
            . '/';
    }

    public static function getByModelAndGroup($model, $group)
    {
        if ($model->isNewRecord) {
            return [];
        }
        return self::find()
            ->andFilterWhere(['modelId' => $model->id])
            ->andFilterWhere(['in', 'modelClassName', self::getModelClassNameSet($model)])
            ->andFilterWhere(['like', 'group', $group])
            ->all();
    }

    private static function getModelClassNameSet($model)
    {
        $nameSpaceArray = explode('\\', $model::className());
        $target = array_search('backend', $nameSpaceArray);
        $target = ($target) ? $target : array_search('frontend', $nameSpaceArray);
        $target = ($target) ? $target : array_search('common', $nameSpaceArray);
        if ($target) {
            foreach (['frontend', 'backend', 'common'] as $application) {
                $nameSpaceArray[$target] = $application;
                $output[] = implode('\\', $nameSpaceArray);
            }
            return $output;
        } else {
            return [$model::className()];
        }

    }

    public static function getAllFilesOfModel($model)
    {
        return self::getByModelAndGroup($model, null);
    }

    public static function getByName($name)
    {
        return self::find()->andWhere(['like', 'filename', $name])->one();
    }

    public function getPresetFolder($preset)
    {
        return Yii::getAlias('@webroot') . '/images'
            . '/' . $this->folderName
            . '/' . $preset
            . '/' . date('Y', $this->createdAt)
            . '/';
    }

    public function getUrl($preset = null)
    {
        if ($this->isImage and null == $preset) {
            throw new InvalidParamException(
                "\$preset parameter should be passed to getUrl() method when calling on an image"
            );
        }
        if ($this->isImage) {
            return Yii::$app->urlManager->baseUrl . '/images'
                . '/' . $this->folderName
                . '/' . $preset
                . '/' . date('Y', $this->createdAt)
                . '/' . $this->filename;
        } else {
            return Url::to(['/file/serve-file', 'name' => $this->filename]);
        }
    }

    private function prepareFileName()
    {
        return time().'-'.Inflector::slug($this->resource->name);
    }
}
