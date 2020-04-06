<?php

namespace extensions\notification;

use Yii;
use yii\base\InvalidConfigException;
use modules\user\common\models\User;
use extensions\notification\channels\Channel;

abstract class Notification extends \yii\base\BaseObject
{
    public $description;
    public $category;
    public $data = [];
    public $moduleId;

    protected $recipients;
    protected $permissions;

    abstract public function getTitle();

    abstract public function getChannels();

    public function init()
    {
        if (!isset($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        if (!empty($this->permissions)) {
            $this->setRecipientsByPermissions();
        }
        parent::init();
    }

    public function shouldSend(Channel $channel)
    {
        return true;
    }

    public function getRoute()
    {
        return null;
    }

    public function setRecipients($users)
    {
        if (!is_array($users)) {
            $users = [$users];
        }
        $this->recipients = $users;
    }

    public function getRecipients()
    {
        return $this->recipients;
    }

    public function setPermissions(array $permissions)
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }
        $this->permissions = $permissions;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function send()
    {
        Yii::$app->notifier->send($this, $this->channels);
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

    public static function create($params = [])
    {
        return new static($params);
    }
}
