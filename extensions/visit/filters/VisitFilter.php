<?php

namespace extensions\visit\filters;

use Yii;
use yii\web\Controller;

class VisitFilter extends \yii\base\Behavior
{
    public $actions = [];
    public $visitCounterAttribute = 'visitCounter';

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'increaseVisitCounter'
        ];
    }

    public function increaseVisitCounter($event)
    {
        $actionId = $event->action->id;
        if (array_key_exists($actionId, $this->actions)) {
            $modelClassName = $this->actions[$actionId]['modelClassName'];
            $quertParameter = $this->actions[$actionId]['quertParameter'] ?? 'id';
            $model = $modelClassName::findOne([
                'id' => Yii::$app->request->get($quertParameter)
            ]);
            if ($model) {
                Yii::$app->db->createCommand()->update(
                    $model->tableName(),
                    [
                        $this->visitCounterAttribute => $model->{$this->visitCounterAttribute} + 1
                    ],
                    ['id' => $model->id]
                )->execute();
            }
        }
    }
}
