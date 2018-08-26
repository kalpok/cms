<?php

namespace modules\user\backend\classes;

use Yii;
use yii\helpers\Json;

class AuthAssignment extends \yii\base\Object
{
    private static $permissions = [];
    private static $availableModules = [];

    public static function getAvailableModules()
    {
        if (empty(static::$availableModules)) {
            $permissions = static::getPermissionsSortedByModules();
            foreach ($permissions as $ownerModule => $items) {
                if (static::isModuleAvailable($ownerModule)) {
                    $title = static::getModuleTitle($ownerModule);
                    static::$availableModules[$ownerModule] = $title;
                }
            }
        }
        return static::$availableModules;
    }

    public static function getPermissionsSortedByModules()
    {
        if (empty(static::$permissions)) {
            $permissions = Yii::$app->authManager->getPermissions();
            foreach ($permissions as $permission) {
                $modulePermission = explode('.', $permission->name);
                $ownerModule = $modulePermission[0];
                static::$permissions[$ownerModule][$permission->name] = $permission->description;
            }
        }
        return static::$permissions;
    }

    public static function assignToUser($userId, $permissions)
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($userId);
        $auth->invalidateCache();
        foreach ($permissions as $permissionName) {
            $permission = $auth->getPermission($permissionName);
            if (isset($permission)) {
                Yii::$app->authManager->assign($permission, $userId);
            }
        }
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
}
