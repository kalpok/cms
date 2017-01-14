<?php
namespace modules\page\backend\controllers;

use Yii;
use kalpok\controllers\AdminController;
use yii\filters\AccessControl;
use modules\page\backend\models\Page;
use modules\page\backend\models\PageSearch;

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
                            'roles' => ['page.update'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['page.delete'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['page.create'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'gallery'],
                            'roles' => ['page.create', 'page.update', 'page.delete'],
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
                'ownerModelClassName' => Page::className()
            ]
        ];
    }

    public function init()
    {
        $this->modelClass = Page::className();
        $this->searchClass = PageSearch::className();
        parent::init();
    }

    public function actionCreate()
    {
        $model = new Page();
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post())) {
            if ($_POST['Page']['parentId'] != 0) {
                $parent =  Page::findOne($_POST['Page']['parentId']);
                $success = $model->appendTo($parent);
            } else {
                $success = $model->makeRoot();
            }
            if ($success) {
                Yii::$app->session->addFlash(
                    'success',
                    'برگه جدید با موفقیت در سیستم درج شد.'
                );
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $page = $this->findModel($id);
        $parent = $page->parents(1)->one();
        $children = $page->children()->all();
        return $this->render('view', [
            'model' => $page,
            'parent' => $parent,
            'children' => $children,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($_POST['Page']['parentId'] != '0') {
                $parent = $model->parents(1)->one();
                if (!isset($parent) or $parent->id != $_POST['Page']['parentId']) {
                    $newParent = Page::findOne($_POST['Page']['parentId']);
                    $success = $model->appendTo($newParent);
                } else {
                    $success = $model->save();
                }
            } else {
                $success = ($model->isRoot()) ? $model->save() : $model->makeRoot();
            }
            if ($success) {
                Yii::$app->session->addFlash(
                    'success',
                    'برگه ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
                );
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithChildren();
        Yii::$app->session->addFlash(
            'success',
            'برگه مورد نظر با موفقیت از سیستم حذف شد.'
        );
        return $this->redirect(['index']);
    }
}
