<?php
namespace core\grid;

use yii\base\InvalidConfigException;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $permissions = [];
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!is_array($this->permissions)) {
            throw new InvalidConfigException('$permissions has to be an array of allowed permissions for each button.');
        }
        if (!empty($this->permissions)) {
            foreach ($this->permissions as $key => $allowedPermissions) {
                if (!$this->checkIfUserHas($allowedPermissions)) {
                    $this->buttons[$key] = function ($url, $model, $key) {return;};
                }
            }
        }
        parent::init();
        $this->initDefaultButtons();
    }

    private function checkIfUserHas($allowedPermissions)
    {
        $visible = false;
        if (!empty($allowedPermissions)) {
            foreach ($allowedPermissions as $permission) {
                if (\Yii::$app->user->can($permission)) {
                    $visible = true;
                }
            }
        }
        return $visible;
    }
}
