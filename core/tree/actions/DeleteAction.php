<?php
namespace core\tree\actions;

use Yii;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;

class DeleteAction extends \yii\base\Action
{
    public $modelClass;
    public $isAjax = false;
    public $destinationView = 'index';

    public function init()
    {
        if (empty($this->modelClass)) {
            throw new InvalidConfigException("`modelClass` property must be set.");
        }
    }

    public function run($id)
    {
        $model = $this->findModel($id);
        $success = $model->deleteWithChildren();
        $msg = [
            'status' => ($success) ? 'success' : 'danger',
            'message' => ($success) ? 'داده مورد نظر با موفقیت از سیستم حذف شد.'
                : $model->getErrors('id')
        ];
        if ($this->isAjax) {
            echo Json::encode($msg);
            exit;
        }
        Yii::$app->session->addFlash($msg['status'], $msg['message']);
        return $this->controller->redirect([$this->destinationView]);
    }

    private function findModel($id)
    {
        if ( ($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
