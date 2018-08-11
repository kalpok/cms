<?php

namespace core\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;

class AjaxAdminController extends AdminController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'create' => ['post'],
                    'update' => ['post'],
                    'view' => ['post']
                ]
            ],
            [
                'class' => ContentNegotiator::class,
                'only' => ['view', 'update', 'create', 'delete'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ],
        ];
    }

    public function actionView($id)
    {
        echo Json::encode(
            [
                'content' => $this->renderAjax('view', ['model' => $this->findModel($id)])
            ]
        );
        exit;
    }

    public function actionCreate()
    {
        $model = new $this->modelClass;
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode(
                [
                    'status' => 'success',
                    'message' => 'داده مورد نظر با موفقیت در سیستم درج شد.'
                ]
            );
            exit;
        }
        echo Json::encode(
            [
                'content' => $this->renderAjax('_form', ['model' => $model])
            ]
        );
        exit;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode(
                [
                    'status' => 'success',
                    'message' => 'آیتم ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
                ]
            );
            exit;
        }
        echo Json::encode(
            [
                'content' => $this->renderAjax('_form', ['model' => $model])
            ]
        );
        exit;
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        echo Json::encode(
            [
                'status' => 'success',
                'message' => 'داده مورد نظر با موفقیت از سیستم حذف شد.'
            ]
        );
        exit;
    }
}
