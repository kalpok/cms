<?php

namespace modules\slider\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class ManageController extends Controller
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
                            'actions' => ['home-fa', 'home-en'],
                            'roles' => ['slider.manager'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        $actions = [
            'home-fa' => [
                'class' => 'extensions\gallery\actions\GalleryAction',
                'handle' => 'home-fa'
            ]
        ];
        if (\Yii::$app->i18n->isMultiLanguage()) {
            $actions['home-en'] = [
                'class' => 'extensions\gallery\actions\GalleryAction',
                'handle' => 'home-en'
            ];
        }
        return $actions;
    }
}
