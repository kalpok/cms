<?php
namespace modules\user\install\console;

use modules\user\common\rbac\UserTypeRule;

class RbacController extends \yii\console\Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        $rule = new UserTypeRule;
        $auth->add($rule);

        $operator = $auth->createRole('operator');
        $operator->ruleName = $rule->name;
        $auth->add($operator);

        $editor = $auth->createRole('editor');
        $editor->ruleName = $rule->name;
        $auth->add($editor);
        $auth->addChild($editor, $operator);

        $superuser = $auth->createRole('superuser');
        $superuser->ruleName = $rule->name;
        $auth->add($superuser);
        $auth->addChild($superuser, $editor);

        echo "command executed successfully. \n";
        return 0;
    }
}
