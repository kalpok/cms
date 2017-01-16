<?php
namespace extensions\gallery\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\VerbFilter;
use extensions\gallery\models\Image;
use extensions\gallery\models\Gallery;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;

class GalleryController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'remove-image' => ['post'],
                    'add-image' => ['post'],
                    'edit-image' => ['post'],
                    'delete' => ['post']
                ],
            ],
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ]
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['operator'],
                    ]
                ]
            ]
        ];
    }

    public function actionAddImage()
    {
        $model = new Image;
        $model->galleryId = (int)Yii::$app->request->get('galleryId');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode(
                array(
                    'status'=>'success',
                    'message'=> 'عکس با موفقیت به گالری افزوده شد.'
                )
            );
            exit;
        }
        echo Json::encode(
            array(
                'status' => 'renderEmptyForm',
                'content' => $this->renderAjax(
                    '@extensions/gallery/views/_form.php',
                    array('model'=>$model)
                )
            )
        );
        exit;
    }

    public function actionEditImage()
    {
        $id = (int)Yii::$app->request->get('id');
        $model = Image::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode(
                array(
                    'status'=>'success',
                    'message'=> 'ویرایش اطلاعات عکس با موفقیت انجام شد.'
                )
            );
            exit;
        }
        echo Json::encode(
            array(
                'status' => 'renderEmptyForm',
                'content' => $this->renderAjax(
                    '@extensions/gallery/views/_form.php',
                    array('model'=>$model)
                )
            )
        );
        exit;
    }

    public function actionRemoveImage()
    {
        $id = (int)Yii::$app->request->get('id');
        Image::findOne($id)->delete();

        echo Json::encode(
            array(
                'status'=>'success',
                'message'=> 'عملیات حذف با موفقیت انجام شد.'
            )
        );
    }

    public function actionDelete($id)
    {
        $returnUrl = urldecode(Yii::$app->request->get('returnUrl'));
        $ownerId = (int) urldecode(Yii::$app->request->get('ownerId'));
        $ownerClass = Gallery::findOne($id)->owner;
        $owner = $ownerClass::findOne($ownerId)->deleteGallery();
        Yii::$app->session->addFlash(
            'success',
            'گالری با موفقیت حذف شد.'
        );
        return $this->redirect($returnUrl);
    }
}
