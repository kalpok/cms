<?php
// TODO
namespace modules\user\backend\models;

use Yii;
use yii\helpers\Json;

class AuthAssignment extends \yii\base\Object
{
    private static $permisions = [];
    private static $availableModules = [];

    public static function getPermissionsSortedByModules()
    {
        if (empty(static::$permisions)) {
            $permisions = Yii::$app->authManager->getPermissions();
            foreach ($permisions as $permision) {
                $data = Json::decode($permision->data);
                if (isset($data['owner'])) {
                    $ownerModule = $data['owner'];
                    static::$permisions[$ownerModule][$permision->name] = $permision->description;
                }
            }
        }
        return static::$permisions;
    }

    public static function getAvailableModules()
    {
        if (empty(static::$availableModules)) {
            $permisions = static::getPermissionsSortedByModules();
            foreach ($permisions as $ownerModule => $items) {
                if (static::isModuleAvailable($ownerModule)) {
                    $title = static::getModuleTitle($ownerModule);
                    static::$availableModules[$ownerModule] = $title;
                }
            }
        }
        return static::$availableModules;
    }

    private static function isModuleAvailable($module)
    {
        if (in_array($module, static::getInstalledModules())) {
            return true;
        }
        return false;
    }

    private static function getInstalledModules()
    {
        $modules = Yii::$app->getModules();
        return array_keys($modules);
    }

    private static function getModuleTitle($moduleName)
    {
        $module = Yii::$app->getModule($moduleName);
        if (isset($module->title)) {
            return $module->title;
        } else {
            return 'نام ماژول نا مشخص است';
        }
    }

    public static function assignToUser($userId, $permisions)
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($userId);
        foreach ($permisions as $permisionName) {
            $permision = $auth->getPermission($permisionName);
            if (isset($permision)) {
                Yii::$app->authManager->assign($permision, $userId);
            }
        }
    }
}
