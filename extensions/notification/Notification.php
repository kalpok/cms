<?php

namespace extensions\notification;

use Yii;
use modules\user\common\models\User;

abstract class Notification extends \yii\base\BaseObject
{
    protected $description;
    protected $route;
    protected $module;
    protected $recipients = [];
    protected $permissions;

    abstract public function getTitle();

    abstract public function getChannels();

    abstract public function getCategory();

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setRecipients(array $users)
    {
        $this->recipients = array_merge($users, $this->recipients);
    }

    public function getRecipients()
    {
        return $this->recipients;
    }

    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
        $this->setRecipientsByPermissions();
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function send()
    {
        Yii::$app->notifier->send($this, $this->channels);
    }

    public function shouldSend(Channel $channel)
    {
        return true;
    }

    public static function create($params = [])
    {
        return new static($params);
    }

    protected function setRecipientsByPermissions()
    {
        $userIds = $this->findUserIdsByPermissions();
        $this->setRecipientsByUserIds($userIds);
    }

    protected function findUserIdsByPermissions()
    {
        $userIds = [];
        foreach ($this->permissions as $permission) {
            $userIds = array_merge(
                $userIds,
                Yii::$app->authManager->getUserIdsByRole($permission)
            );
        }
        return array_unique($userIds);
    }

    protected function setRecipientsByUserIds($userIds)
    {
        $recipients = [];
        foreach ($userIds as $userId) {
            $recipients[] = User::findOne($userId);
        }
        $this->setRecipients($recipients);
    }
}
