<?php
namespace modules\user\backend\controllers;

use Yii;
use core\web\AdminController;
use yii\filters\AccessControl;
use modules\user\backend\models\User;
use modules\user\backend\models\UserSearch;
use modules\user\backend\models\AuthAssignment;

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
        // TODO
        $modules = AuthAssignment::getAvailableModules();
        $allPermissions = AuthAssignment::getPermissionsSortedByModules();
        $userPermissions = Yii::$app->authManager->getRolesByUser($id);
        if (!empty(Yii::$app->request->post('permisions'))) {
            AuthAssignment::assignToUser($id, Yii::$app->request->post('permisions'));
            Yii::$app->session->addFlash(
                'success',
                'دسترسی درخواست شده با موفقیت به کاربر مورد نظر تخصیص داده شد.'
            );
            return $this->redirect(['index']);
        } else {
            return $this->render('assign', [
                'modules' => $modules,
                'allPermissions' => $allPermissions,
                'userPermissions' => array_keys($userPermissions),
            ]);
        }
    }
}
