<?php
namespace modules\user\backend\controllers;

use Yii;
use yii\filters\AccessControl;
use core\controllers\AdminController;
use modules\user\backend\models\ProfileField;
use modules\user\backend\models\ProfileFieldSearch;

class ProfileController extends AdminController
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
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = ProfileField::className();
        $this->searchClass = ProfileFieldSearch::className();
        parent::init();
    }
}
