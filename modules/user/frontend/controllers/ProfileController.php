<?php

namespace modules\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use modules\user\frontend\models\User;
use modules\user\frontend\models\Profile;
use modules\user\frontend\models\Field;

class ProfileController extends Controller
{
    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('view', ['user' => $user]);
    }

    public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $user = User::findOne(Yii::$app->user->id);
        $fields = Field::find()->orderBy('priority DESC')->all();
        if (!empty(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            foreach ($post['data'] as $profileFieldId => $data) {
                foreach ($data as $dataId => $dataValue) {
                    if ($dataId == 0) {
                        $profileData = new Profile;
                        $profileData->userId = Yii::$app->user->id;
                        $profileData->profileFieldId = $profileFieldId;
                        $profileData->data = $dataValue;
                        $profileData->save();
                    } else {
                        $profileData = Profile::findOne($dataId);
                        $profileData->data = $dataValue;
                        $profileData->save();
                    }
                }
            }
        }
        return $this->render('update', ['user' => $user, 'fields' => $fields]);
    }
}
