<?php
namespace kalpok\rbac;

use Yii;
use yii\rbac\Rule;
use kalpok\modules\user\common\models\User;

class UserTypeRule extends Rule
{
    public $name = 'userType';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $userType = Yii::$app->user->identity->type;
            switch ($item->name) {
                case 'superuser':
                    return $userType == User::TYPE_SUPERUSER;
                case 'editor':
                    return $userType == User::TYPE_EDITOR
                        || $userType == User::TYPE_SUPERUSER;
                case 'operator':
                    return $userType == User::TYPE_OPERATOR
                        || $userType == User::TYPE_EDITOR
                        || $userType == User::TYPE_SUPERUSER;
                default:
                    break;
            }
        }
        return false;
    }
}
