<?php

namespace modules\user\backend\controllers;

use Yii;
use yii\filters\AccessControl;
use core\controllers\AdminController;
use modules\user\backend\models\User;
use modules\user\backend\models\UserSearch;
use modules\user\backend\classes\AuthAssignment;

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
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = User::className();
        $this->searchClass = UserSearch::className();
        parent::init();
    }

    public function actionUpdate($id)
    {
        $this->modelScenario = 'update';
        return parent::actionUpdate($id);
    }

    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'changePassword';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'رمز عبور با موفقیت تغییر کرد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('changePassword', [
                'model' => $model,
            ]);
        }
    }

    public function actionAssign($id)
    {
        if (Yii::$app->request->post('permissions')) {
            AuthAssignment::assignToUser(
                $id,
                Yii::$app->request->post('permissions')
            );
            Yii::$app->session->addFlash(
                'success',
                'دسترسی درخواست شده با موفقیت به کاربر مورد نظر تخصیص داده شد.'
            );
            return $this->redirect(['index']);
        } else {
            return $this->render('assign', [
                'modules' => AuthAssignment::getAvailableModules(),
                'allPermissions' => AuthAssignment::getPermissionsSortedByModules(),
                'userPermissions' => array_keys(
                    Yii::$app->authManager->getPermissionsByUser($id)
                )
            ]);
        }
    }
}
