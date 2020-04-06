<?php

namespace extensions\notification\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use extensions\notification\models\NotificationSearch;
use extensions\notification\models\Notification;

class NotifController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@extensions/notification/views/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $notification = Notification::findOne($id);
        $notification->read = true;
        $notification->save();
        return $this->redirect(@unserialize($notification->route));
    }
}
