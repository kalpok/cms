<?php

namespace extensions\file\controllers;

use Yii;
use yii\helpers\Json;
use yii\imagine\Image;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use extensions\file\models\File;
use yii\web\NotFoundHttpException;
use extensions\file\models\EditorFile;
use extensions\file\models\EditorImage;

class FileController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'ajax-delete' => ['post'],
                ],
            ],
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['ajax-delete'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ]
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'except' => ['serve-file', 'serve-image'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['operator']
                    ]
                ]
            ]
        ];
    }

    public function actionEditorUpload()
    {
        $url = $message = null;
        $file = ($_GET['type'] == 'file') ? new EditorFile : new EditorImage;
        $file->folderName = $_GET['module'];
        $file->modelClassName = $_GET['classname'];
        $file->resource = UploadedFile::getInstanceByName("upload");
        $file->modelId = isset($_GET['modelid']) ? $_GET['modelid'] : null;
        if ($file->validate()) {
            if ($file->save()) {
                $url = $file->getUrl('editor');
            } else {
                $message = 'خطایی در آپلود فایل رخ داده است. لطفا دوباره امتحان کنید.';
            }
        }else{
            $message = $file->getErrorsAsString();
        }
        echo "<script type='text/javascript'>
                window.parent.CKEDITOR.tools.callFunction(
                    {$_GET['CKEditorFuncNum']},
                    '{$url}',
                    '{$message}'
                );
            </script>";
    }

    public function actionAjaxDelete()
    {
        if (isset($_POST['id'])) {
            if (File::findOne($_POST['id'])->delete()){
                echo Json::encode(
                    array(
                        'status'=>'success',
                        'message'=> 'فایل با موفقیت حذف شد.'
                    )
                );
            }else{
                echo Json::encode(
                    array(
                        'status'=>'failure',
                        'message'=> 'مشکلی در حذف فایل رخ داده است.'
                    )
                );
            }
            exit;
        }
    }

    public function actionServeFile($name)
    {
        $file = File::getByName($name);
        if (isset($file)) {
            if (!empty($file->path) && file_exists($file->path)) {
                header('Content-type: ' . mime_content_type($file->path));
                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:".filesize($file->path));
                header("Content-disposition: attachment; filename={$file->originalName}");
                readfile($file->path);
                Yii::$app->end();
            }
        }
        throw new NotFoundHttpException(
            "The requested file does not exist on this server."
        );
    }

    public function actionServeImage()
    {
        $preset = $_GET['preset'];
        list($width, $height) = $this->resolvePreset($preset);
        $image = File::getByName($_GET['name']);
        if (isset($image) && is_file($image->path)) {
            $presetFolder = $image->getPresetFolder($preset);
            $fileCachePath = $presetFolder.$image->filename;
            FileHelper::createDirectory($presetFolder);
            if ($preset == 'editor') {
                copy($image->path, $fileCachePath);
            } else {
                Image::getImagine()
                    ->open($image->path)
                    ->thumbnail(new \Imagine\Image\Box($width, $height))
                    ->save($fileCachePath);
            }
            header('Content-type: ' . mime_content_type($fileCachePath));
            readfile($fileCachePath);
            exit();
        }
    }

    private function resolvePreset($preset)
    {
        if ($preset == 'editor') {
            return [null, null];
        }
        $presetsFilePath = Yii::$app->view->theme->basePath . '/presets.php';
        if (file_exists($presetsFilePath)) {
            $presets = require($presetsFilePath);
            if (isset($presets[$preset])) {
                return [
                    $presets[$preset]['width'],
                    $presets[$preset]['height']
                ];
            }
        }
        throw new NotFoundHttpException(
            "Either `presets.php` file does not exist in `{$presetsFilePath}`, or requested preset `{$preset}` is not set."
        );
    }
}
