<?php
namespace extensions\gallery\actions;

use extensions\gallery\models\Gallery;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;

class GalleryAction extends \yii\base\Action
{
    public $ownerModelClassName;
    public $handle;

    public function init()
    {
        if (empty($this->ownerModelClassName) && empty($this->handle)) {
            throw new InvalidConfigException(
                "Either `ownerModelClassName` or `handle` property of GalleryAction must be set."
            );

        }
    }

    public function run($id = null)
    {
        if (isset($this->ownerModelClassName, $id)) {
            return $this->showModelsGallery($id);
        } elseif (isset($this->handle)) {
            return $this->showGalleryByHandle();
        }else{
            throw new NotFoundHttpException("Can't find requested gallery.");
        }
    }

    private function showModelsGallery($id)
    {
        $model = $this->findModel($id);
        $gallery = $model->getGallery();
        if (null == $gallery) {
            $gallery = $model->createGallery();
            \Yii::$app->session->addFlash(
                'success',
                'گالری با موفقیت ساخته شد.'
            );
        }
        return $this->controller->render(
            'gallery',
            [
                'model' => $model,
                'gallery' => $gallery
            ]
        );
    }

    private function showGalleryByHandle()
    {
        $gallery = Gallery::loadByHandle($this->handle);
        if (null == $gallery) {
            $gallery = Gallery::createForHandle($this->handle);
        }
        return $this->controller->render(
            'gallery',
            [
                'gallery' => $gallery
            ]
        );
    }

    private function findModel($id)
    {
        $modelClass = $this->ownerModelClassName;
        if ( ($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
