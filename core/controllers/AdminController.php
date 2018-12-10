<?php

namespace core\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;

class AdminController extends Controller
{
    public $modelClass;
    public $searchClass;
    public $modelScenario;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ]
        ];
    }

    public function init()
    {
        if (!isset($this->modelClass, $this->searchClass)) {
            throw new InvalidConfigException("
                both \$modelClass and \$searchClass properties must be set.
            ");
        }
    }

    public function actionIndex()
    {
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new $this->modelClass;
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'آیتم ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->delete()) {
            foreach ($model->getErrors('id') as $error) {
                Yii::$app->session->addFlash('danger', $error);
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت از سیستم حذف شد.'
            );
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $modelClass = $this->modelClass;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
