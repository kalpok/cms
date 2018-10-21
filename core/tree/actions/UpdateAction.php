<?php
namespace core\tree\actions;

use Yii;
use yii\web\NotFoundHttpException;

class UpdateAction extends CreateAction
{
    public $formView = 'update';

    public function run()
    {
        $model = $this->findModel(Yii::$app->request->get('id'));
        if ($model->load(Yii::$app->request->post())) {
            if ($model->parentId != '0') {
                $parent = $model->parents(1)->one();
                if (!isset($parent) or $parent->id != $model->parentId) {
                    $newParent = $this->modelClass::findOne($model->parentId);
                    $success = $model->appendTo($newParent);
                } else {
                    $success = $model->save();
                }
            } else {
                $success = $model->isRoot() ? $model->save()
                    : $model->makeRoot();
            }
            if ($success) {
                return $this->renderSuccess($model);
            }
        }
        return $this->renderForm($model);
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
