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
        return [
            'home-fa' => [
                'class' => 'kalpok\gallery\actions\GalleryAction',
                'handle' => 'home-fa'
            ],
            'home-en' => [
                'class' => 'kalpok\gallery\actions\GalleryAction',
                'handle' => 'home-en'
            ],
        ];
    }
}
