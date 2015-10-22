<?php

namespace core\modules\setting\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use core\modules\setting\models\Setting;

class ManageController extends \yii\web\Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['superuser'],
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        $settings = Setting::find()->indexBy('key')->all();
        if (Model::loadMultiple($settings, Yii::$app->request->post())
            && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت در سیستم درج شد.'
            );
            return $this->redirect('index');
        }

        return $this->render('index', ['settings' => $settings]);
    }

    public function actionResetCache()
    {
        Yii::$app->cache->flush();
        Yii::$app->session->addFlash(
            'success',
            'کش سیستم با موفقیت ریست شد.'
        );
        return $this->redirect('index');
    }
}
