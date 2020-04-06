<?php
namespace core\tree\actions;

use Yii;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

class CreateAction extends \yii\base\Action
{
    public $modelClass;
    public $isAjax = false;
    public $formView = 'create';
    public $ajaxFormView = '_form';
    public $successView = 'view';

    public function init()
    {
        if (empty($this->modelClass)) {
            throw new InvalidConfigException("`modelClass` property must be set.");
        }
    }

    public function run()
    {
        $model = new $this->modelClass();
        $model->loadDefaultValues();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->parentId != 0) {
                $parent =  $this->modelClass::findOne($model->parentId);
                $success = $model->appendTo($parent);
            } else {
                $success = $model->makeRoot();
            }
            if ($success) {
                return $this->renderSuccess($model);
            }
        }
        return $this->renderForm($model);
    }

    protected function renderSuccess($model)
    {
        $msg = [
            'status' => 'success',
            'message' => 'عملیات با موفقیت انجام شد.'
        ];
        if ($this->isAjax) {
            echo Json::encode($msg);
            exit;
        }
        Yii::$app->session->addFlash($msg['status'], $msg['message']);
        return $this->controller->redirect([$this->successView, 'id' => $model->id]);
    }

    protected function renderForm($model)
    {
        $data = ['model' => $model];
        if ($this->isAjax) {
            echo Json::encode(['content' => $this->controller->renderAjax($this->ajaxFormView, $data)]);
            exit;
        }
        return $this->controller->render($this->formView, $data);
    }
}
