<?php

namespace extensions\tag\controllers;

use yii\db\Query;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;

class TagController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['ajax-find-tags'],
                        'roles' => ['@']
                    ]
                ]
            ],
            [
                'class' => ContentNegotiator::class,
                'only' => ['ajax-find-tags'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }

    public function actionAjaxFindTags($q = null)
    {
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = (new Query())
                ->select('title AS id, title AS text')
                ->from('tag')
                ->where(['like', 'title', $q])
                ->all();
            $out['results'] = array_values($data);
        }
        echo Json::encode($out);
        exit;
    }
}
