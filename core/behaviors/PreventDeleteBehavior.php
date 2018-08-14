<?php

namespace core\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class PreventDeleteBehavior extends Behavior
{
    public $relations;

    public function init()
    {
        if (!isset($this->relations)) {
            throw new InvalidConfigException("relations attribute must be set");
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'canDelete'
        ];
    }

    public function canDelete($event)
    {
        foreach ($this->relations as $relation) {
            $method = $relation['relationMethod'];
            $count = $this->owner->$method()->count();
            if ($count != 0) {
                $count = Yii::$app->formatter->asFarsiNumber($count);
                $this->owner->addError(
                    'id',
                    "آیتم انتخاب شده به دلیل اتصال به $count {$relation['relationName']} غیرقابل حذف می باشد."
                );
                $event->isValid = false;
            }
        }
        return true;
    }
}
