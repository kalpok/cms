<?php

namespace modules\user\common\components;

use Yii;
use yii\base\InvalidConfigException;

class User extends \yii\web\User
{
    private $isSuperuser;

    public function can($permissionName, $params = [], $allowCaching = true)
    {
        if (!Yii::$app->user->isGuest) {
            if ($this->isSuperuser()) {
                return true;
            }
        }
        return parent::can($permissionName, $params = [], $allowCaching = true);
    }

    public function canAccessAny($permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->can($permission)) {
                return true;
            }
        }
        return false;
    }

    public function isSuperuser()
    {
        if (!isset($this->isSuperuser)) {
            $this->isSuperuser = Yii::$app->getAuthManager()->checkAccess($this->getId(), 'superuser');
        }
        return $this->isSuperuser;
    }

    public function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);
        $identity->failedAttempts = 0;
        $identity->lastLoggedInAt = time();
        $identity->save();
    }
}
