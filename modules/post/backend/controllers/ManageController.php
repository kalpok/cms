<?php

namespace modules\post\backend\controllers;

use yii\filters\AccessControl;
use core\controllers\AdminController;
use modules\post\backend\models\Post;
use extensions\comment\actions\IndexAction;
use modules\post\backend\models\PostSearch;

/**
 * ManageController implements the CRUD actions for Post model.
 */
class ManageController extends AdminController
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
                            'actions' => ['update'],
                            'roles' => ['post.update'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['post.delete'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['post.create'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'gallery', 'comment'],
                            'roles' => ['post.create', 'post.update', 'post.delete'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        return [
            'gallery' => [
                'class' => 'extensions\gallery\actions\GalleryAction',
                'ownerModelClassName' => Post::className()
            ],
            'comment' => [
                'class' => IndexAction::class,
                'moduleId' => 'post',
                'ownerClassName' => Post::class
            ]
        ];
    }

    public function init()
    {
        $this->modelClass = Post::className();
        $this->searchClass = PostSearch::className();
        parent::init();
    }
}
