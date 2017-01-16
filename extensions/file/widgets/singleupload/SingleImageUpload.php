<?php
namespace extensions\file\widgets\singleupload;

class SingleImageUpload extends FileUpload
{
    public function run()
    {
        $uploadedImages = $this->model->getFiles($this->group);
        return $this->render(
            'singleImage',
            [
                'model' => $this->model,
                'uploadedImages' => $uploadedImages,
                'fileObject' => $this->createFileObject(),
                'inputDisplay' => (!empty($uploadedImages)) ? 'none' : '',
                'uniqueId' => \Yii::$app->getSecurity()->generateRandomString(3)
            ]
        );
    }
}
